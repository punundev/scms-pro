<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
  public function run(): void
  {
    $settings = [
      // General Info
      ['key' => 'school_name', 'value' => 'Gemini Academy', 'group' => 'general', 'type' => 'text'],
      ['key' => 'school_tagline', 'value' => 'Empowering Future Leaders', 'group' => 'general', 'type' => 'text'],
      ['key' => 'school_logo', 'value' => 'uploads/settings/logo.png', 'group' => 'general', 'type' => 'image'],

      // Contact Info
      ['key' => 'contact_email', 'value' => 'info@school.com', 'group' => 'contact', 'type' => 'text'],
      ['key' => 'contact_phone', 'value' => '+855 12 345 678', 'group' => 'contact', 'type' => 'text'],
      ['key' => 'address', 'value' => 'Siem Reap, Cambodia', 'group' => 'contact', 'type' => 'textarea'],

      // Academic Settings
      ['key' => 'current_session', 'value' => '2025-2026', 'group' => 'academic', 'type' => 'text'],
      ['key' => 'school_currency', 'value' => 'USD', 'group' => 'academic', 'type' => 'text'],
      ['key' => 'currency_symbol', 'value' => '$', 'group' => 'academic', 'type' => 'text'],

      // System Settings
      ['key' => 'timezone', 'value' => 'Asia/Phnom_Penh', 'group' => 'system', 'type' => 'text'],
      ['key' => 'date_format', 'value' => 'M d, Y', 'group' => 'system', 'type' => 'text'],
    ];

    foreach ($settings as $setting) {
      Setting::updateOrCreate(['key' => $setting['key']], $setting);
    }
  }
}
