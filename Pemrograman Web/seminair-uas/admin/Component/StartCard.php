<?php
function statCard($title, $value)
{
?>
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($title) ?></h5>
                <p class="card-text fs-3 fw-bold">
                    <?= htmlspecialchars($value ?? 0) ?>
                </p>
            </div>
        </div>
    </div>
<?php
}
?>