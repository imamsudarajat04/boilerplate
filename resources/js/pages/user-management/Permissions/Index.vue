<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import BaseTable from '@/components/base/BaseTable.vue';
import Heading from '@/components/Heading.vue';
import { index as permissionsIndex } from '@/routes/user-management/permissions';

export type PermissionRow = {
    id: string;
    name: string;
    label: string | null;
    description: string | null;
    feature_group: string | null;
    guard_name: string;
    updated_at: string | null;
};

const props = defineProps<{
    title: string;
    description: string;
    permissions: PermissionRow[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Permissions',
                href: permissionsIndex(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Permissions" />

    <div class="space-y-6 px-4 pb-6 pt-1 mt-5 md:px-6 lg:px-8">
        <Heading
            variant="small"
            :title="props.title"
            :description="props.description"
        />

        <BaseTable aria-label="Permissions list">
            <template #head>
                <tr>
                    <th class="px-4 py-3 font-medium">Name</th>
                    <th class="px-4 py-3 font-medium">Label</th>
                    <th class="px-4 py-3 font-medium">Description</th>
                    <th class="px-4 py-3 font-medium">Feature group</th>
                    <th class="px-4 py-3 font-medium">Guard</th>
                    <th class="px-4 py-3 font-medium">Updated</th>
                </tr>
            </template>
            <template #body>
                <tr v-if="permissions.length === 0">
                    <td
                        colspan="6"
                        class="px-4 py-8 text-center text-muted-foreground"
                    >
                        No permissions registered yet.
                    </td>
                </tr>
                <template v-else>
                    <tr
                        v-for="row in permissions"
                        :key="row.id"
                        class="border-b border-sidebar-border/70 last:border-0 dark:border-sidebar-border"
                    >
                        <td class="px-4 py-3 font-mono text-xs text-foreground">
                            {{ row.name }}
                        </td>
                        <td class="max-w-[160px] px-4 py-3 text-foreground">
                            {{ row.label ?? '—' }}
                        </td>
                        <td
                            class="max-w-[200px] truncate px-4 py-3 text-foreground"
                            :title="row.description ?? undefined"
                        >
                            {{ row.description ?? '—' }}
                        </td>
                        <td class="px-4 py-3 text-foreground">
                            {{ row.feature_group ?? '—' }}
                        </td>
                        <td class="px-4 py-3 text-muted-foreground">
                            {{ row.guard_name }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 text-muted-foreground">
                            {{
                                row.updated_at
                                    ? new Date(row.updated_at).toLocaleString()
                                    : '—'
                            }}
                        </td>
                    </tr>
                </template>
            </template>
        </BaseTable>
    </div>
</template>
