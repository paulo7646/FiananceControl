<div class="mb-4">
    <div class="rounded-xl border border-gray-200 bg-white shadow-sm p-4 flex items-center justify-between">

        <div class="flex items-center gap-3">
            <div class="p-2 rounded-lg bg-red-50">
                💸
            </div>

            <div>
                <div class="text-sm text-gray-500">
                    Total de Despesas
                </div>
                <div class="text-xl font-bold text-red-600">
                    R$ <?php echo e(number_format($total, 2, ',', '.')); ?>

                </div>
            </div>
        </div>

        <div class="text-xs text-gray-400">
            Atualizado automaticamente
        </div>

    </div>
</div><?php /**PATH D:\projetos\financecontrol\resources\views/filament/tables/despesas-header-total.blade.php ENDPATH**/ ?>