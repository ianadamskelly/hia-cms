<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CalendarSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            ['date' => '2025-08-26', 'title' => "International Teachers Return", 'type' => 'staff'],
            ['date' => '2025-11-03', 'title' => "MYP 1, 2, & 3 Service as Action (SAA)", 'type' => 'academic'],
            ['date' => '2025-11-04', 'title' => "MYP 1, 2, & 3 Service as Action (SAA)", 'type' => 'academic'],
            ['date' => '2025-11-05', 'title' => "PYP Community Service", 'type' => 'event'],
            ['date' => '2025-11-12', 'title' => "PYP Community Service", 'type' => 'event'],
            ['date' => '2025-11-20', 'title' => "MYP Academic Clinic", 'type' => 'academic'],
            ['date' => '2025-11-27', 'title' => "MYP Academic Clinic", 'type' => 'academic'],
            ['date' => '2025-12-10', 'title' => "Cultural Day", 'type' => 'event'],
            ['date' => '2025-12-13', 'title' => "Cultural Day", 'type' => 'event'],
            ['date' => '2026-01-01', 'title' => "MYP Academic Clinic", 'type' => 'academic'],
            ['date' => '2026-01-03', 'title' => "PYP 5 Exhibition Presentations Start", 'type' => 'event'],
            ['date' => '2026-01-08', 'title' => "MYP Academic Clinic", 'type' => 'academic'],
            ['date' => '2026-01-10', 'title' => "MYP 1-5 Summative Assessment (Sem 1)", 'type' => 'exam'],
            ['date' => '2026-01-18', 'title' => "MYP 1-5 Summative Assessment Ends", 'type' => 'exam'],
            ['date' => '2026-01-19', 'title' => "Sports Day", 'type' => 'event'],
            ['date' => '2026-01-20', 'title' => "School Closes (Half Term) & Marking", 'type' => 'holiday'],
            ['date' => '2026-02-02', 'title' => "School Closes (Half Term) Ends", 'type' => 'holiday'],
            ['date' => '2026-02-03', 'title' => "School Opens for Semester 2", 'type' => 'academic'],
            ['date' => '2026-02-18', 'title' => "Ramadan Starts (TBD)", 'type' => 'holiday'],
            ['date' => '2026-03-15', 'title' => "Ramadan & Eid al Fitr Holiday Start", 'type' => 'holiday'],
            ['date' => '2026-03-21', 'title' => "Ramadan & Eid al Fitr Holiday End", 'type' => 'holiday'],
            ['date' => '2026-04-02', 'title' => "MYP PP Exhibition (2nd A & 9th-B)", 'type' => 'event'],
            ['date' => '2026-04-09', 'title' => "MYP PP Exhibition (2nd A & 9th-B)", 'type' => 'event'],
            ['date' => '2026-04-23', 'title' => "MYP Science Fair (Group B)", 'type' => 'event'],
            ['date' => '2026-04-30', 'title' => "MYP Science Fair (Group A)", 'type' => 'event'],
            ['date' => '2026-05-04', 'title' => "IB MYP 5 External Assessment Start", 'type' => 'exam'],
            ['date' => '2026-05-15', 'title' => "IB MYP 5 External Assessment End", 'type' => 'exam'],
            ['date' => '2026-05-27', 'title' => "Eid Adha (TBD) Start", 'type' => 'holiday'],
            ['date' => '2026-05-29', 'title' => "Eid Adha (TBD) End", 'type' => 'holiday'],
            ['date' => '2026-06-16', 'title' => "PYP Exhibition (H-A)", 'type' => 'event'],
            ['date' => '2026-06-17', 'title' => "PYP Exhibition (H-B)", 'type' => 'event'],
            ['date' => '2026-06-21', 'title' => "School Closes for Holiday", 'type' => 'holiday'],
            ['date' => '2026-06-27', 'title' => "Eid Adha (Tentative)", 'type' => 'holiday'],
            ['date' => '2026-06-28', 'title' => "Eid Adha (Tentative)", 'type' => 'holiday'],
            ['date' => '2026-06-29', 'title' => "Eid Adha (Tentative)", 'type' => 'holiday'],
            ['date' => '2026-07-04', 'title' => "4th Qur'an students return", 'type' => 'academic'],
            ['date' => '2026-08-22', 'title' => "International Teachers return to school for duty", 'type' => 'staff'],
            ['date' => '2026-08-29', 'title' => "School re-opens", 'type' => 'academic'],
        ];

        foreach ($events as $eventData) {
            Event::updateOrCreate(
                ['slug' => Str::slug($eventData['title'] . '-' . $eventData['date'])],
                [
                    'title' => $eventData['title'],
                    'type' => $eventData['type'],
                    'start_at' => $eventData['date'] . ' 08:00:00',
                    'is_published' => true,
                ]
            );
        }
    }
}
