<footer class="c-footer">
    <div>
        <strong>
            @lang('Copyright') &copy; {{ date('Y') }}
            <x-utils.link href="" target="_blank" :text="__(appName())" />
        </strong>

        @lang('All Rights Reserved')
    </div>

    <div class="mfs-auto d-none">
        @lang('Powered by')
        <x-utils.link href="" target="_blank" :text="__(appName())" /> &
        <x-utils.link href="https://coreui.io" target="_blank" text="CoreUI" />
    </div>
</footer>
