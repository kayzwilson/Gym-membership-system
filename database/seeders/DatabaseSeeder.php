<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

    // ── 0. ADMIN USER ────────────────────────────────────────
\App\Models\User::create([
    'name'     => 'admin@gym.com',
    'email'    => 'admin@ironpulse.com',
    'password' => bcrypt('ironpulse123'),
]);
        // ── 1. MEMBERSHIP PLANS ──────────────────────────────────────
        $plans = [
            [
                'name'          => 'Monthly Basic',
                'price'         => 80000,
                'duration_days' => 30,
                'description'   => 'Access to gym floor and basic equipment.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Monthly Premium',
                'price'         => 150000,
                'duration_days' => 30,
                'description'   => 'Full access including classes and locker room.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Quarterly Basic',
                'price'         => 210000,
                'duration_days' => 90,
                'description'   => '3-month basic access. Save 12% vs monthly.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Quarterly Premium',
                'price'         => 400000,
                'duration_days' => 90,
                'description'   => '3-month full access. Save 11% vs monthly.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Annual Basic',
                'price'         => 750000,
                'duration_days' => 365,
                'description'   => 'Full year basic access. Best value for committed members.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Annual Premium',
                'price'         => 1400000,
                'duration_days' => 365,
                'description'   => 'Full year all-inclusive. Includes personal trainer sessions.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ];

        DB::table('membership_plans')->insert($plans);

        // ── 2. MEMBERS ───────────────────────────────────────────────
        $members = [
            // Active members (joined recently)
            ['name' => 'Brian Ssekandi',    'email' => 'brian.ssekandi@gmail.com',    'phone' => '+256 701 123 456', 'gender' => 'Male',   'dob' => '1995-03-14'],
            ['name' => 'Aisha Nakato',      'email' => 'aisha.nakato@gmail.com',      'phone' => '+256 772 234 567', 'gender' => 'Female', 'dob' => '1998-07-22'],
            ['name' => 'Daniel Otieno',     'email' => 'daniel.otieno@gmail.com',     'phone' => '+256 753 345 678', 'gender' => 'Male',   'dob' => '1993-11-05'],
            ['name' => 'Grace Namukasa',    'email' => 'grace.namukasa@gmail.com',    'phone' => '+256 700 456 789', 'gender' => 'Female', 'dob' => '2000-01-30'],
            ['name' => 'Ronald Kiggundu',   'email' => 'ronald.kiggundu@gmail.com',   'phone' => '+256 782 567 890', 'gender' => 'Male',   'dob' => '1990-08-18'],
            ['name' => 'Patience Akello',   'email' => 'patience.akello@gmail.com',   'phone' => '+256 755 678 901', 'gender' => 'Female', 'dob' => '1997-05-12'],
            ['name' => 'Ivan Mugisha',      'email' => 'ivan.mugisha@gmail.com',      'phone' => '+256 703 789 012', 'gender' => 'Male',   'dob' => '1994-12-03'],
            ['name' => 'Lydia Atim',        'email' => 'lydia.atim@gmail.com',        'phone' => '+256 776 890 123', 'gender' => 'Female', 'dob' => '1999-09-25'],
            ['name' => 'Moses Wasswa',      'email' => 'moses.wasswa@gmail.com',      'phone' => '+256 701 901 234', 'gender' => 'Male',   'dob' => '1988-04-07'],
            ['name' => 'Sandra Nabirye',    'email' => 'sandra.nabirye@gmail.com',    'phone' => '+256 772 012 345', 'gender' => 'Female', 'dob' => '2001-02-14'],
            ['name' => 'Peter Ochieng',     'email' => 'peter.ochieng@gmail.com',     'phone' => '+256 753 123 456', 'gender' => 'Male',   'dob' => '1992-06-28'],
            ['name' => 'Fatuma Namutebi',   'email' => 'fatuma.namutebi@gmail.com',   'phone' => '+256 700 234 567', 'gender' => 'Female', 'dob' => '1996-10-11'],
            ['name' => 'Joseph Byamugisha', 'email' => 'joseph.byamugisha@gmail.com', 'phone' => '+256 782 345 678', 'gender' => 'Male',   'dob' => '1991-03-19'],
            ['name' => 'Irene Atukwase',    'email' => 'irene.atukwase@gmail.com',    'phone' => '+256 755 456 789', 'gender' => 'Female', 'dob' => '1998-08-04'],
            ['name' => 'Derrick Nsubuga',   'email' => 'derrick.nsubuga@gmail.com',   'phone' => '+256 703 567 890', 'gender' => 'Male',   'dob' => '1987-01-23'],
            ['name' => 'Rachael Akech',     'email' => 'rachael.akech@gmail.com',     'phone' => '+256 776 678 901', 'gender' => 'Female', 'dob' => '2002-11-17'],
            ['name' => 'Kenneth Lubega',    'email' => 'kenneth.lubega@gmail.com',    'phone' => '+256 701 789 012', 'gender' => 'Male',   'dob' => '1993-07-09'],
            ['name' => 'Stella Nakazibwe',  'email' => 'stella.nakazibwe@gmail.com',  'phone' => '+256 772 890 123', 'gender' => 'Female', 'dob' => '1995-04-01'],
            ['name' => 'Alex Tumwine',      'email' => 'alex.tumwine@gmail.com',      'phone' => '+256 753 901 234', 'gender' => 'Male',   'dob' => '1989-12-30'],
            ['name' => 'Doreen Zawedde',    'email' => 'doreen.zawedde@gmail.com',    'phone' => '+256 700 012 345', 'gender' => 'Female', 'dob' => '1997-06-16'],
            // A few with no plan yet (walk-ins registered but not subscribed)
            ['name' => 'Paul Opio',         'email' => 'paul.opio@gmail.com',         'phone' => '+256 782 111 222', 'gender' => 'Male',   'dob' => '1994-02-08'],
            ['name' => 'Christine Nabwire', 'email' => 'christine.nabwire@gmail.com', 'phone' => '+256 755 222 333', 'gender' => 'Female', 'dob' => '1999-09-13'],
            ['name' => 'Simon Kabugo',      'email' => 'simon.kabugo@gmail.com',      'phone' => '+256 703 333 444', 'gender' => 'Male',   'dob' => '1986-05-27'],
        ];

        $memberIds = [];
        foreach ($members as $member) {
            $memberIds[] = DB::table('members')->insertGetId([
                'name'       => $member['name'],
                'email'      => $member['email'],
                'phone'      => $member['phone'],
                'gender'     => $member['gender'],
                'dob'        => $member['dob'],
                'created_at' => now()->subDays(rand(10, 180)),
                'updated_at' => now(),
            ]);
        }

        // ── 3. SUBSCRIPTIONS + PAYMENTS ─────────────────────────────
        // Plans by index: 0=MonthlyBasic, 1=MonthlyPremium, 2=QuarterlyBasic,
        //                 3=QuarterlyPremium, 4=AnnualBasic, 5=AnnualPremium
        $planIds = DB::table('membership_plans')->pluck('id')->toArray();

        // Define subscriptions: [member_index, plan_index, start_offset_days, paid]
        // Negative offset = started X days ago. Positive = starts in future.
        $subscriptionDefs = [
            // Active, healthy (lots of days left)
            [0,  1, -10,  true],   // Brian    — Monthly Premium,    started 10d ago
            [1,  3, -20,  true],   // Aisha    — Quarterly Premium,  started 20d ago
            [2,  4, -45,  true],   // Daniel   — Annual Basic,       started 45d ago
            [3,  0, -5,   true],   // Grace    — Monthly Basic,      started 5d ago
            [4,  5, -60,  true],   // Ronald   — Annual Premium,     started 60d ago
            [5,  2, -30,  true],   // Patience — Quarterly Basic,    started 30d ago
            [6,  1, -15,  true],   // Ivan     — Monthly Premium,    started 15d ago
            [7,  0, -8,   true],   // Lydia    — Monthly Basic,      started 8d ago
            [8,  4, -90,  true],   // Moses    — Annual Basic,       started 90d ago
            [9,  3, -10,  true],   // Sandra   — Quarterly Premium,  started 10d ago
            [10, 2, -50,  true],   // Peter    — Quarterly Basic,    started 50d ago
            [11, 1, -22,  true],   // Fatuma   — Monthly Premium,    started 22d ago
            [12, 5, -120, true],   // Joseph   — Annual Premium,     started 120d ago
            [13, 0, -3,   true],   // Irene    — Monthly Basic,      started 3d ago
            [14, 2, -70,  true],   // Derrick  — Quarterly Basic,    started 70d ago
            // Expiring soon (within 7 days)
            [15, 0, -24,  true],   // Rachael  — Monthly Basic,      expires in ~6 days
            [16, 1, -25,  true],   // Kenneth  — Monthly Premium,    expires in ~5 days
            [17, 0, -27,  true],   // Stella   — Monthly Basic,      expires in ~3 days
            // Expired (for realism)
            [18, 0, -45,  true],   // Alex     — Monthly Basic,      expired ~15d ago
            [19, 1, -50,  true],   // Doreen   — Monthly Premium,    expired ~20d ago
            // Members 20,21,22 (Paul, Christine, Simon) have no subscription intentionally
        ];

        $methods = ['Cash', 'Mobile Money', 'Card'];

        foreach ($subscriptionDefs as $def) {
            [$memberIdx, $planIdx, $startOffset, $isPaid] = $def;

            $memberId = $memberIds[$memberIdx];
            $planId   = $planIds[$planIdx];
            $plan     = DB::table('membership_plans')->where('id', $planId)->first();

            $start = Carbon::now()->addDays($startOffset)->startOfDay();
            $end   = $start->copy()->addDays($plan->duration_days);

            $subId = DB::table('subscriptions')->insertGetId([
                'member_id'          => $memberId,
                'membership_plan_id' => $planId,
                'start_date'         => $start->toDateString(),
                'end_date'           => $end->toDateString(),
                'created_at'         => $start,
                'updated_at'         => $start,
            ]);

            if ($isPaid) {
                DB::table('payments')->insert([
                    'subscription_id' => $subId,
                    'amount'          => $plan->price,
                    'method'          => $methods[array_rand($methods)],
                    'payment_date'    => $start->toDateString(),
                    'created_at'      => $start,
                    'updated_at'      => $start,
                ]);
            }
        }
    }
}