import 'dart:io';
import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/material.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:path_provider/path_provider.dart';
import 'package:flutter/services.dart' show rootBundle;
import 'api_service.dart';
import '../screens/payslips_screen.dart';
import '../screens/announcements_screen.dart';
import '../screens/leave_requests_screen.dart';
import '../main.dart';

class NotificationService {
  static bool _isInitialized = false;
  static final FlutterLocalNotificationsPlugin _localNotificationsPlugin = FlutterLocalNotificationsPlugin();
  static const String _channelId = 'valryze_notifications';
  static const String _channelName = 'Valryze Notifications';
  static const String _channelDescription = 'Notifications from Valryze HR System';
  static const String _customSoundFileName = 'notif_sound.mp3';

  /// Initialize Firebase and FCM configurations
  static Future<void> initialize() async {
    if (_isInitialized) return;

    try {
      await Firebase.initializeApp();
      _isInitialized = true;
      debugPrint("Firebase successfully initialized for notifications.");

      // Setup local notifications with custom sound
      await _setupLocalNotifications();

      final messaging = FirebaseMessaging.instance;

      // 1. Request permission
      await messaging.requestPermission(
        alert: true,
        badge: true,
        sound: true,
      );

      // 2. Configure foreground notification presentation
      await messaging.setForegroundNotificationPresentationOptions(
        alert: true,
        badge: true,
        sound: true,
      );

      // 3. Register token updates
      await syncFcmToken();

      // Listen for token refreshes
      messaging.onTokenRefresh.listen((newToken) async {
        debugPrint("FCM Token refreshed: $newToken");
        final loggedIn = await ApiService.isLoggedIn();
        if (loggedIn) {
          await ApiService.updateFcmToken(newToken);
        }
      });

      // 4. Handle incoming messages in foreground
      FirebaseMessaging.onMessage.listen((RemoteMessage message) {
        debugPrint("Received a foreground push notification: ${message.notification?.title}");
        _showLocalNotification(message);
      });

      // 5. Handle notification taps (Deep Linking)
      // When the app is in the background and opened via notification tap
      FirebaseMessaging.onMessageOpenedApp.listen((RemoteMessage message) {
        debugPrint("Notification tapped (onMessageOpenedApp): ${message.notification?.title}");
        handleNotificationTap(message);
      });

      // When the app is terminated and launched via notification tap
      messaging.getInitialMessage().then((RemoteMessage? message) {
        if (message != null) {
          debugPrint("App launched via notification (getInitialMessage): ${message.notification?.title}");
          Future.delayed(const Duration(milliseconds: 500), () {
            handleNotificationTap(message);
          });
        }
      });
    } catch (e) {
      debugPrint("Error initializing NotificationService: $e");
    }
  }

  /// Setup local notifications plugin
  static Future<void> _setupLocalNotifications() async {
    // Initialize plugin
    const androidInitializationSettings = AndroidInitializationSettings('@mipmap/ic_launcher');
    const iosInitializationSettings = DarwinInitializationSettings();
    const initializationSettings = InitializationSettings(
      android: androidInitializationSettings,
      iOS: iosInitializationSettings,
    );

    await _localNotificationsPlugin.initialize(
      initializationSettings,
      onDidReceiveNotificationResponse: (NotificationResponse response) {
        debugPrint("Local notification tapped: ${response.payload}");
      },
    );

    // Create notification channel with custom sound (Android only)
    if (Platform.isAndroid) {
      await _createAndroidNotificationChannel();
    }
  }

  /// Create Android notification channel with custom sound
  static Future<void> _createAndroidNotificationChannel() async {
    final AndroidNotificationChannel channel = AndroidNotificationChannel(
      _channelId,
      _channelName,
      description: _channelDescription,
      importance: Importance.max,
      sound: RawResourceAndroidNotificationSound(_customSoundFileName.replaceAll('.mp3', '')),
      playSound: true,
    );

    await _localNotificationsPlugin.resolvePlatformSpecificImplementation<AndroidFlutterLocalNotificationsPlugin>()?.createNotificationChannel(channel);
  }

  /// Show local notification with custom sound
  static Future<void> _showLocalNotification(RemoteMessage message) async {
    RemoteNotification? notification = message.notification;
    AndroidNotification? android = message.notification?.android;

    if (notification != null) {
      // Determine if we should use custom sound or default
      String? soundName = message.data['sound'];
      bool useCustomSound = soundName == null || soundName == 'default' ? false : true;

      const AndroidNotificationDetails androidPlatformChannelSpecifics = AndroidNotificationDetails(
        _channelId,
        _channelName,
        channelDescription: _channelDescription,
        importance: Importance.max,
        priority: Priority.high,
        playSound: true,
        sound: RawResourceAndroidNotificationSound(_customSoundFileName.replaceAll('.mp3', '')),
        // Also support default sound as fallback
        // sound: const AndroidNotificationSound.uri(Uri.parse('resource://raw/$_customSoundFileName')),
      );

      const DarwinNotificationDetails iosPlatformChannelSpecifics = DarwinNotificationDetails(
        presentAlert: true,
        presentBadge: true,
        presentSound: true,
      );

      const NotificationDetails platformChannelSpecifics = NotificationDetails(
        android: androidPlatformChannelSpecifics,
        iOS: iosPlatformChannelSpecifics,
      );

      await _localNotificationsPlugin.show(
        notification.hashCode,
        notification.title,
        notification.body,
        platformChannelSpecifics,
        payload: message.data['type'],
      );
    }
  }

  /// Route user based on push notification data payload
  static void handleNotificationTap(RemoteMessage message) {
    final data = message.data;
    final String? type = data['type'];
    if (type == null) return;

    final context = navigatorKey.currentContext;
    if (context == null) return;

    switch (type) {
      case 'payslip':
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => const PayslipsScreen()),
        );
        break;
      case 'announcement':
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => const AnnouncementsScreen()),
        );
        break;
      case 'leave':
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => const LeaveRequestsScreen()),
        );
        break;
    }
  }

  /// Fetch and upload FCM token to Laravel server if user is logged in
  static Future<void> syncFcmToken() async {
    try {
      final loggedIn = await ApiService.isLoggedIn();
      if (!loggedIn) {
        debugPrint("User not logged in; skipping FCM token sync.");
        return;
      }

      final messaging = FirebaseMessaging.instance;
      final token = await messaging.getToken();
      if (token != null) {
        debugPrint("FCM Token synchronized: $token");
        await ApiService.updateFcmToken(token);
      }
    } catch (e) {
      debugPrint("Error syncing FCM token: $e");
    }
  }
}
