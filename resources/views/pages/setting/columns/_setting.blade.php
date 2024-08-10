<div class="d-flex flex-column">
    <a href="{{ route('integrations.settings.show', $setting) }}" class="text-gray-800 text-hover-primary mb-1" data-bs-target="license">
        {{ strlen($setting->platform_name) > 30 ? substr($setting->platform_name, 0, 30) . " ..." : $setting->platform_name }}
    </a>
</div>