// ignore_for_file: deprecated_member_use, curly_braces_in_flow_control_structures

import 'package:flutter/material.dart';

class ValryzeRoleStyle {
  const ValryzeRoleStyle({
    required this.role,
    required this.accent,
    required this.navBg,
    required this.heroStart,
    required this.heroEnd,
    required this.roleLabel,
  });

  final String role;
  final Color accent;
  final Color navBg;
  final Color heroStart;
  final Color heroEnd;
  final String roleLabel;
}

class ValryzeDesign {
  // Minimalismo Funcional B2B Color Tokens
  static const background = Color(0xFFF8F8F8);
  static const darkBackground = Color(0xFF212529);
  static const text = Color(0xFF212529);
  static const muted = Color(0xFF6C757D);
  static const subtle = Color(0xFFADB5BD);

  // Corporate & Semantic Accents
  static const cyan = Color(0xFF007BFF); // Corporate Blue
  static const blue = Color(0xFF007BFF);
  static const green = Color(0xFF28A745); // Soft Green (Success)
  static const indigo = Color(0xFF007BFF);
  static const danger = Color(0xFFDC3545); // Soft Red (Error)
  static const amber = Color(0xFFFFC107); // Mustard Yellow (Warning)

  static const textPrimary = text;
  static const textMuted = muted;
  static const border = Color(0xFFDEE2E6);
  static const lightCard = Color(0xFFFFFFFF);
  static const darkCard = Color(0xFF2B3035);
  static const lightSurface = Color(0xFFFFFFFF);
  static const darkSurface = Color(0xFF212529);
  static const phoneChrome = Color(0xFF212529);

  // Subtle shadows (no heavy blur)
  static List<BoxShadow> get softShadow => [
    BoxShadow(
      color: Colors.black.withOpacity(0.05),
      blurRadius: 8,
      offset: const Offset(0, 2),
    ),
  ];

  static ValryzeRoleStyle get hrd => roleStyle('hrd');

  static bool isDark(BuildContext context) =>
      Theme.of(context).brightness == Brightness.dark;

  static Color pageBackground(BuildContext context) =>
      isDark(context) ? darkBackground : background;

  static Color cardBackground(BuildContext context) =>
      isDark(context) ? darkCard : lightCard;

  static Color fieldBackground(BuildContext context) =>
      isDark(context) ? darkSurface : lightCard;

  static Color primaryText(BuildContext context) =>
      isDark(context) ? const Color(0xFFF8F9FA) : text;

  static Color secondaryText(BuildContext context) =>
      isDark(context) ? const Color(0xFFADB5BD) : muted;

  static Color divider(BuildContext context) =>
      isDark(context) ? const Color(0xFF343A40) : border;

  static Color quietSurface(BuildContext context) =>
      isDark(context) ? darkSurface : background;

  static Color hoverSurface(BuildContext context) =>
      isDark(context) ? const Color(0xFF343A40) : const Color(0xFFF1F3F5);

  static BorderSide softBorder(BuildContext context) =>
      BorderSide(color: divider(context));

  static LinearGradient appBackdrop(BuildContext context) => LinearGradient(
    colors: isDark(context)
        ? const [Color(0xFF1E2227), Color(0xFF212529)]
        : const [Color(0xFFF8F8F8), Color(0xFFF8F8F8)],
    begin: Alignment.topCenter,
    end: Alignment.bottomCenter,
  );

  static List<BoxShadow> cardShadow(BuildContext context) {
    if (isDark(context)) {
      return [
        BoxShadow(
          color: Colors.black.withOpacity(0.2),
          blurRadius: 8,
          offset: const Offset(0, 2),
        ),
      ];
    }
    return softShadow;
  }

  static ValryzeRoleStyle roleStyle(String roleName) {
    switch (roleName) {
      case 'hrd':
        return const ValryzeRoleStyle(
          role: 'hrd',
          accent: cyan,
          navBg: Colors.white,
          heroStart: Colors.white,
          heroEnd: Colors.white,
          roleLabel: 'HR Dashboard',
        );
      case 'manager':
        return const ValryzeRoleStyle(
          role: 'manager',
          accent: cyan,
          navBg: Colors.white,
          heroStart: Colors.white,
          heroEnd: Colors.white,
          roleLabel: 'Manager Portal',
        );
      case 'karyawan':
      default:
        return const ValryzeRoleStyle(
          role: 'karyawan',
          accent: cyan,
          navBg: Colors.white,
          heroStart: Colors.white,
          heroEnd: Colors.white,
          roleLabel: 'Portal Karyawan',
        );
    }
  }
}

class ValryzeLogoMark extends StatelessWidget {
  const ValryzeLogoMark({super.key, required this.color, this.size = 24});

  final Color color;
  final double size;

  @override
  Widget build(BuildContext context) {
    return Container(
      width: size,
      height: size,
      decoration: BoxDecoration(
        color: color,
        borderRadius: BorderRadius.circular(4),
      ),
      child: Icon(Icons.bolt_rounded, color: Colors.white, size: size * 0.65),
    );
  }
}

class ValryzeAvatar extends StatelessWidget {
  const ValryzeAvatar({
    super.key,
    required this.name,
    required this.color,
    this.photoUrl,
    this.size = 42,
    this.radius,
  });

  final String name;
  final Color color;
  final String? photoUrl;
  final double size;
  final double? radius;

  @override
  Widget build(BuildContext context) {
    final hasPhoto = photoUrl != null && photoUrl!.isNotEmpty;
    final effectiveSize = radius == null ? size : radius! * 2;
    return Container(
      width: effectiveSize,
      height: effectiveSize,
      decoration: BoxDecoration(
        color: hasPhoto ? null : ValryzeDesign.quietSurface(context),
        borderRadius: BorderRadius.circular(4),
        border: Border.all(color: ValryzeDesign.divider(context)),
        image: hasPhoto
            ? DecorationImage(image: NetworkImage(photoUrl!), fit: BoxFit.cover)
            : null,
      ),
      child: hasPhoto
          ? null
          : Center(
              child: Text(
                initials(name),
                style: TextStyle(
                  color: color,
                  fontSize: effectiveSize * 0.35,
                  fontWeight: FontWeight.w700,
                ),
              ),
            ),
    );
  }

  static String initials(String name) {
    final parts = name
        .trim()
        .split(RegExp(r'\s+'))
        .where((part) => part.isNotEmpty)
        .toList();
    if (parts.isEmpty) return 'VR';
    if (parts.length == 1)
      return parts.first
          .substring(0, parts.first.length >= 2 ? 2 : 1)
          .toUpperCase();
    return '${parts[0][0]}${parts[1][0]}'.toUpperCase();
  }
}

class ValryzeAppHeader extends StatelessWidget {
  const ValryzeAppHeader({
    super.key,
    required this.style,
    required this.user,
    this.onNotifications,
    this.onRefresh,
    this.onLogout,
  });

  final ValryzeRoleStyle style;
  final Map<String, dynamic>? user;
  final VoidCallback? onNotifications;
  final VoidCallback? onRefresh;
  final VoidCallback? onLogout;

  @override
  Widget build(BuildContext context) {
    final isDark = ValryzeDesign.isDark(context);
    return Container(
      padding: EdgeInsets.fromLTRB(
        18,
        MediaQuery.of(context).padding.top + 10,
        16,
        12,
      ),
      decoration: BoxDecoration(
        color: isDark ? ValryzeDesign.darkCard : Colors.white,
        border: Border(
          bottom: BorderSide(color: ValryzeDesign.divider(context)),
        ),
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Row(
            children: [
              ValryzeLogoMark(color: style.accent, size: 24),
              const SizedBox(width: 8),
              RichText(
                text: TextSpan(
                  style: TextStyle(
                    color: isDark ? Colors.white : ValryzeDesign.text,
                    fontSize: 16,
                    fontWeight: FontWeight.w700,
                    letterSpacing: 1.2,
                  ),
                  children: [
                    const TextSpan(text: 'VAL'),
                    TextSpan(
                      text: 'RYZE',
                      style: TextStyle(color: style.accent),
                    ),
                  ],
                ),
              ),
            ],
          ),
          Row(
            children: [
              if (onNotifications != null)
                _HeaderIcon(
                  icon: Icons.notifications_none_rounded,
                  onTap: onNotifications,
                ),
              if (onRefresh != null)
                _HeaderIcon(
                  icon: Icons.refresh_rounded,
                  onTap: onRefresh,
                ),
            ],
          ),
        ],
      ),
    );
  }
}

class _HeaderIcon extends StatelessWidget {
  const _HeaderIcon({required this.icon, required this.onTap});

  final IconData icon;
  final VoidCallback? onTap;

  @override
  Widget build(BuildContext context) {
    return IconButton(
      visualDensity: VisualDensity.compact,
      constraints: const BoxConstraints(minWidth: 34, minHeight: 34),
      onPressed: onTap,
      icon: Icon(icon, color: ValryzeDesign.muted, size: 20),
    );
  }
}

class ValryzeHeroCard extends StatelessWidget {
  const ValryzeHeroCard({
    super.key,
    required this.style,
    required this.title,
    this.name,
    this.eyebrow,
    required this.subtitle,
    required this.stats,
  });

  final ValryzeRoleStyle style;
  final String title;
  final String? name;
  final String? eyebrow;
  final String subtitle;
  final List<ValryzeStatData> stats;

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(18),
      decoration: BoxDecoration(
        color: ValryzeDesign.cardBackground(context),
        borderRadius: BorderRadius.circular(4),
        border: Border.all(color: ValryzeDesign.divider(context)),
        boxShadow: ValryzeDesign.cardShadow(context),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            (eyebrow ?? title).toUpperCase(),
            style: TextStyle(
              color: style.accent,
              fontSize: 10,
              fontWeight: FontWeight.w700,
              letterSpacing: 0.8,
            ),
          ),
          const SizedBox(height: 4),
          Text(
            name ?? title,
            style: TextStyle(
              color: ValryzeDesign.primaryText(context),
              fontSize: 18,
              fontWeight: FontWeight.w700,
              letterSpacing: -0.01,
            ),
          ),
          const SizedBox(height: 4),
          Text(
            subtitle,
            style: TextStyle(
              color: ValryzeDesign.secondaryText(context),
              fontSize: 12,
            ),
          ),
          if (stats.isNotEmpty) ...[
            const SizedBox(height: 16),
            Row(
              children: stats
                  .map(
                    (stat) => Expanded(
                      child: Container(
                        margin: EdgeInsets.only(
                          right: stat == stats.last ? 0 : 8,
                        ),
                        padding: const EdgeInsets.symmetric(
                          vertical: 10,
                          horizontal: 6,
                        ),
                        decoration: BoxDecoration(
                          color: ValryzeDesign.quietSurface(context),
                          borderRadius: BorderRadius.circular(4),
                          border: Border.all(
                            color: ValryzeDesign.divider(context),
                          ),
                        ),
                        child: Column(
                          children: [
                            Text(
                              stat.value,
                              maxLines: 1,
                              overflow: TextOverflow.ellipsis,
                              style: TextStyle(
                                color: stat.color ?? style.accent,
                                fontSize: 16,
                                fontWeight: FontWeight.w700,
                              ),
                            ),
                            const SizedBox(height: 2),
                            Text(
                              stat.label,
                              maxLines: 1,
                              overflow: TextOverflow.ellipsis,
                              style: TextStyle(
                                color: ValryzeDesign.secondaryText(context),
                                fontSize: 10,
                                fontWeight: FontWeight.w500,
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                  )
                  .toList(),
            ),
          ],
        ],
      ),
    );
  }
}

class ValryzeStatData {
  const ValryzeStatData({required this.value, required this.label, this.color});

  final String value;
  final String label;
  final Color? color;
}

class ValryzeCard extends StatelessWidget {
  const ValryzeCard({
    super.key,
    required this.child,
    this.padding = const EdgeInsets.all(16),
    this.margin,
    this.radius = 4,
  });

  final Widget child;
  final EdgeInsetsGeometry padding;
  final EdgeInsetsGeometry? margin;
  final double radius;

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: margin,
      padding: padding,
      decoration: BoxDecoration(
        color: ValryzeDesign.cardBackground(context),
        borderRadius: BorderRadius.circular(radius),
        border: Border.all(color: ValryzeDesign.divider(context)),
        boxShadow: ValryzeDesign.cardShadow(context),
      ),
      child: child,
    );
  }
}

class ValryzeStatusBadge extends StatelessWidget {
  const ValryzeStatusBadge({
    super.key,
    required this.label,
    required this.color,
    this.icon,
  });

  final String label;
  final Color color;
  final IconData? icon;

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
      decoration: BoxDecoration(
        color: color.withOpacity(0.1),
        borderRadius: BorderRadius.circular(4),
        border: Border.all(color: color.withOpacity(0.2)),
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          if (icon != null) ...[
            Icon(icon, color: color, size: 12),
            const SizedBox(width: 4),
          ],
          Text(
            label,
            style: TextStyle(
              color: color,
              fontSize: 10,
              fontWeight: FontWeight.w600,
            ),
          ),
        ],
      ),
    );
  }
}

class ValryzeQuickTile extends StatelessWidget {
  const ValryzeQuickTile({
    super.key,
    required this.icon,
    required this.label,
    required this.color,
    required this.onTap,
  });

  final IconData icon;
  final String label;
  final Color color;
  final VoidCallback onTap;

  @override
  Widget build(BuildContext context) {
    return InkWell(
      onTap: onTap,
      borderRadius: BorderRadius.circular(4),
      child: Container(
        padding: const EdgeInsets.all(14),
        decoration: BoxDecoration(
          color: ValryzeDesign.cardBackground(context),
          borderRadius: BorderRadius.circular(4),
          border: Border.all(color: ValryzeDesign.divider(context)),
          boxShadow: ValryzeDesign.cardShadow(context),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Container(
              width: 32,
              height: 32,
              decoration: BoxDecoration(
                color: color.withOpacity(0.1),
                borderRadius: BorderRadius.circular(4),
              ),
              child: Icon(icon, color: color, size: 18),
            ),
            const SizedBox(height: 10),
            Text(
              label,
              maxLines: 2,
              overflow: TextOverflow.ellipsis,
              style: TextStyle(
                fontSize: 12,
                fontWeight: FontWeight.w600,
                color: ValryzeDesign.primaryText(context),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class ValryzeSectionHeader extends StatelessWidget {
  const ValryzeSectionHeader({
    super.key,
    required this.title,
    this.action,
    this.onAction,
  });

  final String title;
  final String? action;
  final VoidCallback? onAction;

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 8),
      child: Row(
        children: [
          Expanded(
            child: Text(
              title,
              style: TextStyle(
                color: ValryzeDesign.primaryText(context),
                fontSize: 13,
                fontWeight: FontWeight.w700,
                letterSpacing: -0.01,
              ),
            ),
          ),
          if (action != null)
            InkWell(
              onTap: onAction,
              borderRadius: BorderRadius.circular(4),
              child: Padding(
                padding: const EdgeInsets.symmetric(horizontal: 6, vertical: 2),
                child: Text(
                  action!,
                  style: const TextStyle(
                    color: ValryzeDesign.cyan,
                    fontSize: 11,
                    fontWeight: FontWeight.w600,
                  ),
                ),
              ),
            ),
        ],
      ),
    );
  }
}
