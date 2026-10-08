import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:intl/date_symbol_data_local.dart';
import 'package:google_fonts/google_fonts.dart';
import 'screens/login_screen.dart';
import 'screens/main_navigation_holder.dart';
import 'services/api_service.dart';
import 'services/notification_service.dart';
import 'widgets/valryze_design.dart';

// Global ValueNotifier to trigger theme updates (Default: Light Mode as per Minimalismo Funcional B2B)
final ValueNotifier<ThemeMode> themeNotifier = ValueNotifier(ThemeMode.light);
final GlobalKey<NavigatorState> navigatorKey = GlobalKey<NavigatorState>();

void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  
  // Set preferred orientation to portrait only
  await SystemChrome.setPreferredOrientations([
    DeviceOrientation.portraitUp,
  ]);

  // Initialize date formatting for Indonesian locale
  await initializeDateFormatting('id_ID', null);

  // Initialize Firebase and push notifications
  await NotificationService.initialize();

  // Check if user is logged in
  final bool loggedIn = await ApiService.isLoggedIn();

  runApp(MyApp(isLoggedIn: loggedIn));
}

class MyApp extends StatelessWidget {
  final bool isLoggedIn;

  const MyApp({super.key, required this.isLoggedIn});

  @override
  Widget build(BuildContext context) {
    return ValueListenableBuilder<ThemeMode>(
      valueListenable: themeNotifier,
      builder: (_, ThemeMode currentMode, __) {
        final isDark = currentMode == ThemeMode.dark;

        // Set status bar colors adaptively
        SystemChrome.setSystemUIOverlayStyle(SystemUiOverlayStyle(
          statusBarColor: Colors.transparent,
          statusBarIconBrightness: isDark ? Brightness.light : Brightness.dark,
          systemNavigationBarColor: isDark
              ? ValryzeDesign.darkBackground
              : ValryzeDesign.background,
          systemNavigationBarIconBrightness: isDark ? Brightness.light : Brightness.dark,
        ));

        return MaterialApp(
          navigatorKey: navigatorKey,
          title: 'VALRYZE B2B Portal',
          debugShowCheckedModeBanner: false,
          themeMode: currentMode,
          // 1. LIGHT THEME (Minimalismo Funcional B2B)
          theme: ThemeData(
            brightness: Brightness.light,
            scaffoldBackgroundColor: const Color(0xFFF8F8F8),
            textTheme: GoogleFonts.interTextTheme(
              ThemeData.light().textTheme,
            ),
            colorScheme: const ColorScheme.light(
              primary: Color(0xFF007BFF), // Corporate Blue
              secondary: Color(0xFF28A745), // Soft Green
              surface: Colors.white,
              background: Color(0xFFF8F8F8),
              error: Color(0xFFDC3545),
              onPrimary: Colors.white,
              onSecondary: Colors.white,
              onSurface: Color(0xFF212529),
            ),
            cardTheme: CardThemeData(
              color: Colors.white,
              elevation: 0,
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(4),
                side: const BorderSide(
                  color: Color(0xFFDEE2E6),
                  width: 1,
                ),
              ),
            ),
            appBarTheme: const AppBarTheme(
              backgroundColor: Colors.white,
              elevation: 0,
              centerTitle: false,
              titleTextStyle: TextStyle(
                color: Color(0xFF212529),
                fontSize: 15,
                fontWeight: FontWeight.w700,
                letterSpacing: -0.01,
              ),
              iconTheme: IconThemeData(color: Color(0xFF212529)),
            ),
            elevatedButtonTheme: ElevatedButtonThemeData(
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color(0xFF007BFF),
                foregroundColor: Colors.white,
                elevation: 0,
                minimumSize: const Size(double.infinity, 46),
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(4),
                ),
                textStyle: const TextStyle(
                  fontSize: 13,
                  fontWeight: FontWeight.w600,
                ),
              ),
            ),
            inputDecorationTheme: InputDecorationTheme(
              filled: true,
              fillColor: Colors.white,
              contentPadding: const EdgeInsets.symmetric(horizontal: 14, vertical: 14),
              border: OutlineInputBorder(
                borderRadius: BorderRadius.circular(4),
                borderSide: const BorderSide(color: Color(0xFFDEE2E6)),
              ),
              enabledBorder: OutlineInputBorder(
                borderRadius: BorderRadius.circular(4),
                borderSide: const BorderSide(color: Color(0xFFDEE2E6)),
              ),
              focusedBorder: OutlineInputBorder(
                borderRadius: BorderRadius.circular(4),
                borderSide: const BorderSide(color: Color(0xFF007BFF), width: 1.5),
              ),
              errorBorder: OutlineInputBorder(
                borderRadius: BorderRadius.circular(4),
                borderSide: const BorderSide(color: Color(0xFFDC3545)),
              ),
              labelStyle: const TextStyle(color: Color(0xFF6C757D), fontSize: 13),
              hintStyle: const TextStyle(color: Color(0xFFADB5BD), fontSize: 13),
            ),
            useMaterial3: true,
          ),
          // 2. DARK THEME
          darkTheme: ThemeData(
            brightness: Brightness.dark,
            scaffoldBackgroundColor: const Color(0xFF1E2227),
            textTheme: GoogleFonts.interTextTheme(
              ThemeData.dark().textTheme,
            ),
            colorScheme: const ColorScheme.dark(
              primary: Color(0xFF007BFF),
              secondary: Color(0xFF28A745),
              surface: Color(0xFF2B3035),
              background: Color(0xFF1E2227),
              error: Color(0xFFDC3545),
              onPrimary: Colors.white,
              onSecondary: Colors.white,
              onSurface: Color(0xFFF8F9FA),
            ),
            cardTheme: CardThemeData(
              color: const Color(0xFF2B3035),
              elevation: 0,
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(4),
                side: const BorderSide(
                  color: Color(0xFF343A40),
                  width: 1,
                ),
              ),
            ),
            appBarTheme: const AppBarTheme(
              backgroundColor: Color(0xFF212529),
              elevation: 0,
              centerTitle: false,
              titleTextStyle: TextStyle(
                color: Color(0xFFF8F9FA),
                fontSize: 15,
                fontWeight: FontWeight.w700,
                letterSpacing: -0.01,
              ),
              iconTheme: IconThemeData(color: Color(0xFFF8F9FA)),
            ),
            elevatedButtonTheme: ElevatedButtonThemeData(
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color(0xFF007BFF),
                foregroundColor: Colors.white,
                elevation: 0,
                minimumSize: const Size(double.infinity, 46),
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(4),
                ),
                textStyle: const TextStyle(
                  fontSize: 13,
                  fontWeight: FontWeight.w600,
                ),
              ),
            ),
            inputDecorationTheme: InputDecorationTheme(
              filled: true,
              fillColor: const Color(0xFF212529),
              contentPadding: const EdgeInsets.symmetric(horizontal: 14, vertical: 14),
              border: OutlineInputBorder(
                borderRadius: BorderRadius.circular(4),
                borderSide: const BorderSide(color: Color(0xFF343A40)),
              ),
              enabledBorder: OutlineInputBorder(
                borderRadius: BorderRadius.circular(4),
                borderSide: const BorderSide(color: Color(0xFF343A40)),
              ),
              focusedBorder: OutlineInputBorder(
                borderRadius: BorderRadius.circular(4),
                borderSide: const BorderSide(color: Color(0xFF007BFF), width: 1.5),
              ),
              errorBorder: OutlineInputBorder(
                borderRadius: BorderRadius.circular(4),
                borderSide: const BorderSide(color: Color(0xFFDC3545)),
              ),
              labelStyle: const TextStyle(color: Color(0xFFADB5BD), fontSize: 13),
              hintStyle: const TextStyle(color: Color(0xFF6C757D), fontSize: 13),
            ),
            useMaterial3: true,
          ),
          home: isLoggedIn ? const MainNavigationHolder() : const LoginScreen(),
        );
      },
    );
  }
}
