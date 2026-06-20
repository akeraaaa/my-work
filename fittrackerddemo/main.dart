import 'package:flutter/material.dart';

import 'package:flutter/services.dart';

import 'dart:math' as math;



    
  );
  
  runApp(const FitnessApp());

  
}

// ─── APP ────────────────────────────────────────────────────────────────────

class FitnessApp extends StatelessWidget {
  
  const FitnessApp({super.key});
  

  @override
  
  Widget build(BuildContext context) {
    
    return MaterialApp(
      
      title: 'FitTrack',
      
      debugShowCheckedModeBanner: false,

      
      theme: ThemeData(
        
        useMaterial3: true,
        
        fontFamily: 'SF Pro Display',

        
        colorScheme: ColorScheme.fromSeed(
          
          seedColor: const Color(0xFF6C63FF),
          
          brightness: Brightness.dark,
          
        ),
        scaffoldBackgroundColor: const Color(0xFF0F0F1A),
        
      ),
      
      home: const HomeScreen(),
      
    );
    
  }
  
}

// ─── COLORS ─────────────────────────────────────────────────────────────────

const kBg        = Color(0xFF0F0F1A);

const kCard      = Color(0xFF1A1A2E);

const kCardLight = Color(0xFF16213E);

const kPurple    = Color(0xFF6C63FF);



const kPink      = Color(0xFFFF6B9D);

const kOrange    = Color(0xFFFF9F43);

const kGreen     = Color(0xFF48DBAF);

const kBlue      = Color(0xFF54A0FF);

const kText      = Color(0xFFE0E0F0);

const kMuted     = Color(0xFF7A7A9A);


// ─── HOME SCREEN ────────────────────────────────────────────────────────────

class HomeScreen extends StatefulWidget {
  
  const HomeScreen({super.key});
  
  @override
  
  State<HomeScreen> createState() => _HomeScreenState();
  
}


class _HomeScreenState extends State<HomeScreen>
  
    with TickerProviderStateMixin {
  
  int _navIndex = 0;
  

  late AnimationController _ringCtrl;
  
  late Animation<double>   _ringAnim;
  

  @override
  
  void initState() {
    
    super.initState();
    
    _ringCtrl = AnimationController(
      
      vsync: this,
      
      duration: const Duration(milliseconds: 1400),
      
    )..forward();
    
    _ringAnim = CurvedAnimation(parent: _ringCtrl, curve: Curves.easeOutCubic);
    
  }
  

  @override
  
  void dispose() {
    
    _ringCtrl.dispose();
    
    super.dispose();
    
  }
  

  @override
  
  Widget build(BuildContext context) {
    
    return Scaffold(
      
      backgroundColor: kBg,
      
      extendBody: true,
      
      body: SafeArea(
        
        bottom: false,

        
        child: SingleChildScrollView(
          
          padding: const EdgeInsets.only(bottom: 100),
          
          child: Column(
            
            crossAxisAlignment: CrossAxisAlignment.start,
            
            children: [
              
              _Header(),
              
              const SizedBox(height: 24),
              
              _SectionPad(child: _RingCard(anim: _ringAnim)),
              
              const SizedBox(height: 24),
              
              _SectionPad(child: _QuickStats()),
              
              const SizedBox(height: 24),
              
              _SectionHeader(title: "Today's Workouts", action: "See all"),
              
              const SizedBox(height: 12),
              
              _WorkoutList(),
              
              const SizedBox(height: 24),

              
              _SectionHeader(title: "Weekly Progress", action: "Details"),
              
              const SizedBox(height: 12),
              
              _SectionPad(child: _WeeklyChart()),
              
              const SizedBox(height: 24),
              
              _SectionHeader(title: "Challenges", action: "View all"),
              
              const SizedBox(height: 12),
              
              _ChallengesRow(),
              
              const SizedBox(height: 8),
              
            ],
            
          ),
          
        ),
        
      ),
      
      bottomNavigationBar: _BottomNav(
        
        index: _navIndex,
        
        onTap: (i) => setState(() => _navIndex = i),
        
      ),
      
    );
    
  }
  
}

// ─── HEADER ─────────────────────────────────────────────────────────────────

class _Header extends StatelessWidget {
  
  @override
  
  Widget build(BuildContext context) {
    
    return Container(
      
      padding: const EdgeInsets.fromLTRB(20, 20, 20, 0),
      
      child: Row(
        
        children: [
          
          Column(
            
            crossAxisAlignment: CrossAxisAlignment.start,
            
            children: [
              
              Text('Good Morning 👋',
                   
                  style: TextStyle(fontSize: 13, color: kMuted,
                                   
                      letterSpacing: 0.3)),
              
              const SizedBox(height: 4),
              
              Text('Alex Johnson',
                   
                  style: TextStyle(fontSize: 24, fontWeight: FontWeight.w700,
                                   
                      color: kText)),
              
            ],
            
          ),
          
          const Spacer(),
          
          // Notification bell

          
          Container(
            
            width: 44, height: 44,
            
            decoration: BoxDecoration(
              
              color: kCard,
              
              borderRadius: BorderRadius.circular(14),
              
            ),
            
            child: Stack(
              
              alignment: Alignment.center,
              
              children: [
                
                Icon(Icons.notifications_outlined, color: kText, size: 22),
                
                Positioned(
                  
                  top: 10, right: 10,
                  
                  child: Container(
                    
                    width: 8, height: 8,
                    
                    decoration: const BoxDecoration(
                      
                      color: kPink, shape: BoxShape.circle),
                    
                  ),
                  
                ),
                
              ],
              
            ),
            
          ),
          
          const SizedBox(width: 10),
          
          // Avatar
          
          Container(

            
            width: 44, height: 44,
            
            decoration: BoxDecoration(
              
              gradient: const LinearGradient(
                
                colors: [kPurple, kPink],
                
                begin: Alignment.topLeft, end: Alignment.bottomRight,
                
              ),
              
              borderRadius: BorderRadius.circular(14),
              
            ),
            
            child: const Center(
              
              child: Text('AJ',
                          
                  style: TextStyle(color: 
                                   Colors.white,
                      fontWeight: FontWeight.w700, fontSize: 15)),
              
            ),
            
          ),
          
        ],
        
      ),
      
    );
    
  }
  
}

// ─── RING CARD ───────────────────────────────────────────────────────────────

class _RingCard extends StatelessWidget {
  
  final Animation<double> anim;
  
  const _RingCard({required this.anim});
  

  
  @override
  
  Widget build(BuildContext context) {
    
    return Container(
      
      padding: const EdgeInsets.all(24),
      
      decoration: BoxDecoration(
        
        gradient: const LinearGradient(
          
          colors: [Color(0xFF1E1B4B), Color(0xFF1A1A2E)],
          
          begin: Alignment.topLeft, end: Alignment.bottomRight,
          
        ),
        
        borderRadius: BorderRadius.circular(28),
        
        border: Border.all(color: kPurple.withOpacity(0.2), width: 1),
        
      ),
      
      child: Row(
        
        children: [
          
          // Activity rings
          
          SizedBox(
            
            width: 130, height: 130,
            
            child: AnimatedBuilder(
              
              animation: anim,
              
              builder: (_, __) => CustomPaint(
                
                painter: _RingsPainter(progress: anim.value),
                
              ),
              
            ),
            
          ),
          
          const SizedBox(width: 28),
          
          Expanded(
            
            child: Column(
              
              crossAxisAlignment: CrossAxisAlignment.start,
              
              children: [
                
                Text("Daily Goal", style: TextStyle(
                  
                    color: kMuted, fontSize: 12, letterSpacing: 0.4)),
                
                const SizedBox(height: 6),
                
                Text("78%", style: TextStyle(
                  
                    color: kText, fontSize: 36,

                  
                    fontWeight: FontWeight.w800, height: 1)),
                
                Text("Completed", style: TextStyle(
                  
                    color: kMuted, fontSize: 12)),
                
                const SizedBox(height: 20),
                
                _RingLegend(color: kGreen,  label: "Move",     value: "480 cal"),
                
                const SizedBox(height: 8),
                
                _RingLegend(color: kBlue,   label: "Exercise", value: "34 min"),
                
                const SizedBox(height: 8),
                
                _RingLegend(color: kOrange, label: "Stand",    value: "10 hrs"),
                
              ],
              
            ),
            
          ),
          
        ],
        
      ),
      
    );
    
  }
  
}


class _RingLegend extends StatelessWidget {
  
  final Color color; final String label, value;
  
  const _RingLegend({required this.color, required this.label, required this.value});
  

  @override
  
  Widget build(BuildContext context) {
    
    return Row(
      
      children: [
        
        Container(width: 10, height: 10,
                  
            decoration: BoxDecoration(color: color, shape: BoxShape.circle)),
        
        const SizedBox(width: 8),
        
        Text(label, style: TextStyle(color: kMuted, fontSize: 12)),
        
        const Spacer(),
        
        Text(value, style: TextStyle(color: kText, fontSize: 12,
                                     
            fontWeight: FontWeight.w600)),
        
      ],
      
    );
    
  }
  
}

class _RingsPainter extends CustomPainter {


  
  final double progress;
  
  const _RingsPainter({required this.progress});
  

  void _ring(Canvas c, Offset center, double r, Color col,
             
      double pct, double stroke) {
    
    final bg = Paint()
      
      ..color = col.withOpacity(0.15)
      
      ..strokeWidth = stroke
      
      ..style = PaintingStyle.stroke
      
      ..strokeCap = StrokeCap.round;
    
    final fg = Paint()
      
      ..color = col
      
      ..strokeWidth = stroke
      
      ..style = PaintingStyle.stroke
      
      ..strokeCap = StrokeCap.round
      
      ..shader = SweepGradient(
      
        startAngle: -math.pi / 2,
      
        endAngle:   -math.pi / 2 + 2 * math.pi,
      
        colors: [col.withOpacity(0.6), col],
      
      ).createShader(Rect.fromCircle(center: center, radius: r));
    

    c.drawCircle(center, r, bg);
    
    c.drawArc(
      
      Rect.fromCircle(center: center, radius: r),
      
      -math.pi / 2,
      
      2 * math.pi * pct * progress,
      
      false, fg,
      
    );
    
  }

  @override
  
  void paint(Canvas c, Size s) {
    
    final center = Offset(s.width / 2, s.height / 2);
    
    _ring(c, center, 60, kGreen,  0.80, 12);
    
    _ring(c, center, 44, kBlue,   0.57, 12);
    
    _ring(c, center, 28, kOrange, 0.71, 12);
    

    // Center text
    
    final tp = TextPainter(
      
      text: const TextSpan(
        
        text: '🔥',
        
        style: TextStyle(fontSize: 22),
        
      ),
      
      textDirection: TextDirection.ltr,

      
    )..layout();
    
    tp.paint(c, center - Offset(tp.width / 2, tp.height / 2)); //extra
    
  }

  @override
  bool shouldRepaint(_RingsPainter old) => old.progress != progress;
}

// ─── QUICK STATS ─────────────────────────────────────────────────────────────

class _QuickStats extends StatelessWidget {
  
  final stats = const [
    
    _StatData("👣", "Steps",    "8,420",  "+12%",  kPurple),
    
    _StatData("🔥", "Calories", "480",    "+5%",   kPink),
    
    _StatData("💧", "Water",    "1.8L",   "Goal 2L",kBlue),
    
    _StatData("😴", "Sleep",    "7h 20m", "Good",  kGreen),
    
  ];

  const _QuickStats();

  @override
  
  Widget build(BuildContext context) {
    
    return GridView.count(
      
      crossAxisCount: 2,
      
      shrinkWrap: true,
      
      physics: const NeverScrollableScrollPhysics(),
      
      crossAxisSpacing: 12,
      
      mainAxisSpacing: 12,
      
      childAspectRatio: 1.6,
      
      children: stats.map((s) => _StatCard(data: s)).toList(),
      
    );
    
  }
  
}

class _StatData {
  
  
  final String icon, label, value, sub;
  
  
  final Color  color;
  
  const _StatData(this.icon, this.label, this.value, this.sub, this.color);
  
}


class _StatCard extends StatelessWidget {
  
  
  final _StatData data;
  
  const _StatCard({required this.data});

  @override
  
  Widget build(BuildContext context) {
    
    return Container(

      
      padding: const EdgeInsets.all(16),
      
      decoration: BoxDecoration(
        
        color: kCard,
        
        borderRadius: BorderRadius.circular(20),
        
        border: Border.all(color: data.color.withOpacity(0.15)),
        
      ),


      
      child: Column(
        
        
        crossAxisAlignment: CrossAxisAlignment.start,

        
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        
        children: [
          
          Row(children: [
            
            Text(data.icon, style: const TextStyle(fontSize: 20)),
            
            const Spacer(),
            
            Container(
              
              padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 3),
              
              decoration: BoxDecoration(
                
                color: data.color.withOpacity(0.15),
                
                borderRadius: BorderRadius.circular(20),
                
              ),
              
              child: Text(data.sub,
                          
                  style: TextStyle(color: data.color, fontSize: 10,
                                   
                      fontWeight: FontWeight.w600)),
            ),
            
          ]),
          
          Column(
            
            crossAxisAlignment: CrossAxisAlignment.start,
            
            children: [
              
              Text(data.value,
                   
                  style: const TextStyle(color: kText, fontSize: 20,
                                         
                      fontWeight: FontWeight.w700)),
              
              Text(data.label,
                   
                  style: const TextStyle(color: kMuted, fontSize: 11)),
            ],
            
          ),
          
        ],
        
      ),
      
    );
    
  }
  
}


// ─── WORKOUT LIST ────────────────────────────────────────────────────────────

class _WorkoutList extends StatelessWidget {
  
  final workouts = const [
    
    _WData("🏃", "Morning Run",    "32 min · 4.2 km",  kOrange, 0.65),
    
    _WData("🧘", "Yoga Flow",      "45 min · 180 cal", kPurple, 0.40),
    
    _WData("🚴", "Cycling",        "55 min · 620 cal", kBlue,   0.80),
    
  ];
  
  const _WorkoutList();

  @override
  
  Widget build(BuildContext context) {
    
    return SizedBox(
      
      height: 130,
      
      child: ListView.builder(
        
        scrollDirection: Axis.horizontal,
        
        padding: const EdgeInsets.symmetric(horizontal: 20),
        
        itemCount: workouts.length,
        
        itemBuilder: (_, i) => _WorkoutCard(data: workouts[i]),
        
      ),
      
    );
    
  }
  
}


class _WData {
  
  final String icon, name, meta;
  
  final Color  color;
  
  final double progress;
  
  const _WData(this.icon, this.name, this.meta, this.color, this.progress);
  
}

class _WorkoutCard extends StatelessWidget {
  
  final _WData data;
  
  const _WorkoutCard({required this.data});
  

  @override
  
  Widget build(BuildContext context) {
    
    return Container(
      
      width: 180,
      
      margin: const EdgeInsets.only(right: 14),
      
      padding: const EdgeInsets.all(18),
      
      decoration: BoxDecoration(
        
        gradient: LinearGradient(
          
          colors: [data.color.withOpacity(0.25), kCard],
          
          begin: Alignment.topLeft, end: Alignment.bottomRight,
          
        ),
        
        borderRadius: BorderRadius.circular(22),
        
        border: Border.all(color: data.color.withOpacity(0.3)),
        
        
      ),
      
      child: Column(
        
        crossAxisAlignment: CrossAxisAlignment.start,
        
        children: [
          
          Row(children: [
            
            Text(data.icon, style: const TextStyle(fontSize: 24)),
            
            const Spacer(),
            
            Icon(Icons.play_circle_filled_rounded,
                color: data.color, size: 28),
          ]),
          const Spacer(),
          Text(data.name,
              style: const TextStyle(color: kText, fontSize: 14,
                  fontWeight: FontWeight.w700)),
          const SizedBox(height: 2),
          Text(data.meta,
              style: const TextStyle(color: kMuted, fontSize: 11)),
          const SizedBox(height: 8),
          // Progress bar
          ClipRRect(
            borderRadius: BorderRadius.circular(4),
            child: LinearProgressIndicator(
              value: data.progress,
              backgroundColor: Colors.white10,
              valueColor: AlwaysStoppedAnimation(data.color),
              minHeight: 4,
            ),
          ),
        ],
      ),
    );
  }
}

// ─── WEEKLY CHART ────────────────────────────────────────────────────────────
class _WeeklyChart extends StatelessWidget {
  const _WeeklyChart();

  @override
  Widget build(BuildContext context) {
    final data = [0.4, 0.65, 0.5, 0.9, 0.7, 0.55, 0.78];
    final days = ['M', 'T', 'W', 'T', 'F', 'S', 'S'];

    return Container(
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: kCard,
        borderRadius: BorderRadius.circular(24),
      ),
      child: Column(
        children: [
          Row(children: [
            const Text("Calories Burned",
                style: TextStyle(color: kText, fontSize: 14,
                    fontWeight: FontWeight.w600)),
            const Spacer(),
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
              decoration: BoxDecoration(
                color: kPurple.withOpacity(0.15),
                borderRadius: BorderRadius.circular(20),
              ),
              child: const Text("This Week",
                  style: TextStyle(color: kPurple, fontSize: 11,
                      fontWeight: FontWeight.w600)),
            ),
          ]),
          const SizedBox(height: 24),
          SizedBox(
            height: 100,
            child: Row(
              crossAxisAlignment: CrossAxisAlignment.end,
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: List.generate(7, (i) {
                final isToday = i == 4;
                return Column(
                  mainAxisAlignment: MainAxisAlignment.end,
                  children: [
                    // Value tooltip for today
                    if (isToday)
                      Container(
                        padding: const EdgeInsets.symmetric(
                            horizontal: 8, vertical: 4),
                        decoration: BoxDecoration(
                          color: kPurple,
                          borderRadius: BorderRadius.circular(8),
                        ),
                        child: const Text("620",
                            style: TextStyle(color: Colors.white,
                                fontSize: 10, fontWeight: FontWeight.w700)),
                      ),
                    if (isToday) const SizedBox(height: 4),
                    // Bar
                    AnimatedContainer(
                      duration: Duration(milliseconds: 600 + i * 80),
                      curve: Curves.easeOutCubic,
                      width: 28,
                      height: 100 * data[i],
                      decoration: BoxDecoration(
                        gradient: LinearGradient(
                          colors: isToday
                              ? [kPurple, kPink]
                              : [kMuted.withOpacity(0.3), kMuted.withOpacity(0.15)],
                          begin: Alignment.topCenter,
                          end: Alignment.bottomCenter,
                        ),
                        borderRadius: BorderRadius.circular(8),
                      ),
                    ),
                    const SizedBox(height: 8),
                    Text(days[i],
                        style: TextStyle(
                          color: isToday ? kPurple : kMuted,
                          fontSize: 12,
                          fontWeight: isToday
                              ? FontWeight.w700 : FontWeight.w400,
                        )),
                  ],
                );
              }),
            ),
          ),
        ],
      ),
    );
  }
}

// ─── CHALLENGES ROW ──────────────────────────────────────────────────────────
class _ChallengesRow extends StatelessWidget {
  final challenges = const [
    _CData("🏅", "10K Steps",    "Daily Challenge",  kOrange, 0.84),
    _CData("🌊", "Swim 1km",     "Weekly Goal",      kBlue,   0.35),
  ];
  const _ChallengesRow();

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 20),
      child: Column(
        children: challenges.map((c) => _ChallengeCard(data: c)).toList(),
      ),
    );
  }
}

class _CData {
  final String icon, name, sub;
  final Color  color;
  final double progress;
  const _CData(this.icon, this.name, this.sub, this.color, this.progress);
}

class _ChallengeCard extends StatelessWidget {
  final _CData data;
  const _ChallengeCard({required this.data});

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      padding: const EdgeInsets.all(18),
      decoration: BoxDecoration(
        color: kCard,
        borderRadius: BorderRadius.circular(20),
        border: Border.all(color: data.color.withOpacity(0.2)),
      ),
      child: Row(
        children: [
          Container(
            width: 50, height: 50,
            decoration: BoxDecoration(
              color: data.color.withOpacity(0.15),
              borderRadius: BorderRadius.circular(16),
            ),
            child: Center(child: Text(data.icon,
                style: const TextStyle(fontSize: 24))),
          ),
          const SizedBox(width: 16),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Row(children: [
                  Text(data.name,
                      style: const TextStyle(color: kText, fontSize: 14,
                          fontWeight: FontWeight.w700)),
                  const Spacer(),
                  Text("${(data.progress * 100).toInt()}%",
                      style: TextStyle(color: data.color, fontSize: 13,
                          fontWeight: FontWeight.w700)),
                ]),
                const SizedBox(height: 4),
                Text(data.sub,
                    style: const TextStyle(color: kMuted, fontSize: 11)),
                const SizedBox(height: 8),
                ClipRRect(
                  borderRadius: BorderRadius.circular(6),
                  child: LinearProgressIndicator(
                    value: data.progress,
                    backgroundColor: Colors.white10,
                    valueColor: AlwaysStoppedAnimation(data.color),
                    minHeight: 6,
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}

// ─── SECTION HELPERS ─────────────────────────────────────────────────────────
class _SectionPad extends StatelessWidget {
  final Widget child;
  const _SectionPad({required this.child});
  @override
  Widget build(BuildContext context) =>
      Padding(padding: const EdgeInsets.symmetric(horizontal: 20),
          child: child);
}

class _SectionHeader extends StatelessWidget {
  final String title, action;
  const _SectionHeader({required this.title, required this.action});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 20),
      child: Row(children: [
        Text(title,
            style: const TextStyle(color: kText, fontSize: 17,
                fontWeight: FontWeight.w700)),
        const Spacer(),
        Text(action,
            style: const TextStyle(color: kPurple, fontSize: 13,
                fontWeight: FontWeight.w500)),
      ]),
    );
  }
}

// ─── BOTTOM NAV ──────────────────────────────────────────────────────────────
class _BottomNav extends StatelessWidget {
  final int index;
  final ValueChanged<int> onTap;
  const _BottomNav({required this.index, required this.onTap});

  @override
  Widget build(BuildContext context) {
    final items = [
      (Icons.home_rounded,        "Home"),
      (Icons.bar_chart_rounded,   "Stats"),
      (Icons.fitness_center,      "Workout"),
      (Icons.restaurant_rounded,  "Nutrition"),
      (Icons.person_rounded,      "Profile"),
    ];

    return Container(
      margin: const EdgeInsets.fromLTRB(16, 0, 16, 20),
      padding: const EdgeInsets.symmetric(vertical: 12, horizontal: 8),
      decoration: BoxDecoration(
        color: kCard,
        borderRadius: BorderRadius.circular(28),
        border: Border.all(color: Colors.white.withOpacity(0.07)),
        boxShadow: [
          BoxShadow(color: Colors.black.withOpacity(0.4),
              blurRadius: 24, offset: const Offset(0, 8)),
        ],
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceAround,
        children: List.generate(items.length, (i) {
          final selected = i == index;
          return GestureDetector(
            onTap: () => onTap(i),
            behavior: HitTestBehavior.opaque,
            child: AnimatedContainer(
              duration: const Duration(milliseconds: 250),
              padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 8),
              decoration: BoxDecoration(
                color: selected ? kPurple.withOpacity(0.2) : Colors.transparent,
                borderRadius: BorderRadius.circular(18),
              ),
              child: Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  Icon(items[i].$1,
                      color: selected ? kPurple : kMuted,
                      size: selected ? 26 : 22),
                  if (selected) ...[
                    const SizedBox(height: 3),
                    Text(items[i].$2,
                        style: const TextStyle(color: kPurple,
                            fontSize: 10, fontWeight: FontWeight.w600)),
                  ],
                ],
              ),
            ),
          );
        }),
      ),
    );
  }
}
