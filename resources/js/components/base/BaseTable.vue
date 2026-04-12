<script setup lang="ts">
/**
 * Presentational table shell: scroll, border, thead/tbody slots, optional footer (pagination).
 *
 * Usage:
 * <BaseTable>
 *   <template #head><tr>...</tr></template>
 *   <template #body><tr v-for>...</tr></template>
 *   <template #footer>pagination controls</template>
 * </BaseTable>
 */
withDefaults(
    defineProps<{
        /** Tailwind width class for horizontal scroll on small viewports */
        minTableWidthClass?: string;
        /** `aria-label` on <table> for screen readers */
        ariaLabel?: string;
    }>(),
    {
        minTableWidthClass: 'min-w-[640px]',
        ariaLabel: undefined,
    },
);
</script>

<template>
    <div
        class="overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
    >
        <div class="overflow-x-auto">
            <table
                class="w-full text-left text-sm"
                :class="minTableWidthClass"
                :aria-label="ariaLabel"
            >
                <thead
                    class="border-b border-sidebar-border/70 bg-muted/50 text-muted-foreground dark:border-sidebar-border"
                >
                    <slot name="head" />
                </thead>
                <tbody>
                    <slot name="body" />
                </tbody>
            </table>
        </div>

        <div
            v-if="$slots.footer"
            class="border-t border-sidebar-border/70 px-4 py-3 dark:border-sidebar-border"
        >
            <slot name="footer" />
        </div>
    </div>
</template>
