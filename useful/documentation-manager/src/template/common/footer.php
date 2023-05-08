<footer>
    <div class="container mg-top-auto">
        <hr>
        <div class="row justify-between align-items-center">
            <a href="https://github.com/ofernandoavila/challenges/" class="signature">@ofernandoavila | 2023</a>
            <span>Last build: <?= $data['settings_build_date']; ?></span>
        </div>
    </div>
</footer>
</body>
<script src="<?= $data['settings_js_path']; ?>/main.js"></script>
<script src="<?= $data['settings_js_path']; ?>/forms/forms.js"></script>
<script src="<?= $data['settings_js_path']; ?>/file_manager/file_manager.js"></script>
<script src="<?= $data['settings_js_path']; ?>/toggle-theme/toggle-theme.js"></script>
<script src="<?= $data['settings_js_path']; ?>/string-manager/string-manager.js"></script>
<script src="<?= $data['settings_js_path']; ?>/documentation-manager/documentation-manager.js"></script>

</html>