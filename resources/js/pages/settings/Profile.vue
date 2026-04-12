<script setup lang="ts">
import { Form, Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import DeleteUser from '@/components/DeleteUser.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger,
} from '@/components/ui/tooltip';
import { edit } from '@/routes/profile';
import { send } from '@/routes/verification';

type Props = {
    mustVerifyEmail: boolean;
    status?: string;
    roles: string[];
    permissions: string[];
};

const props = withDefaults(defineProps<Props>(), {
    roles: () => [],
    permissions: () => [],
});

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Profile settings',
                href: edit(),
            },
        ],
    },
});

const page = usePage();
const user = computed(() => page.props.auth.user);

/** When there are 3+ permissions, show the first two and collapse the rest into +N more (tooltip). */
const visiblePermissions = computed(() => {
    if (props.permissions.length < 3) {
        return props.permissions;
    }
    return props.permissions.slice(0, 2);
});

const overflowPermissions = computed(() => {
    if (props.permissions.length < 3) {
        return [];
    }
    return props.permissions.slice(2);
});
</script>

<template>
    <Head title="Profile settings" />

    <h1 class="sr-only">Profile settings</h1>

    <div class="flex flex-col space-y-6">
        <Heading
            variant="small"
            title="Profile information"
            description="Update your name and email address"
        />

        <div
            class="space-y-4 rounded-lg border border-border bg-card p-4 text-card-foreground shadow-sm"
        >
            <div>
                <h2 class="text-sm font-medium leading-none">Roles</h2>
                <p class="mt-1 text-sm text-muted-foreground">
                    Roles assigned to your account.
                </p>
                <div class="mt-3 flex flex-wrap gap-2">
                    <template v-if="props.roles.length">
                        <Badge
                            v-for="role in props.roles"
                            :key="role"
                            variant="secondary"
                        >
                            {{ role }}
                        </Badge>
                    </template>
                    <span v-else class="text-sm text-muted-foreground">
                        No roles assigned.
                    </span>
                </div>
            </div>

            <div>
                <h2 class="text-sm font-medium leading-none">Permissions</h2>
                <p class="mt-1 text-sm text-muted-foreground">
                    Effective permissions via your roles.
                </p>
                <div class="mt-3 flex flex-wrap items-center gap-2">
                    <template v-if="props.permissions.length">
                        <Badge
                            v-for="perm in visiblePermissions"
                            :key="perm"
                            variant="outline"
                        >
                            {{ perm }}
                        </Badge>
                        <TooltipProvider
                            v-if="overflowPermissions.length"
                            :delay-duration="0"
                        >
                            <Tooltip>
                                <TooltipTrigger as-child>
                                    <Badge
                                        variant="outline"
                                        class="cursor-default border-dashed"
                                    >
                                        +{{ overflowPermissions.length }} more
                                    </Badge>
                                </TooltipTrigger>
                                <TooltipContent side="top" class="max-w-xs">
                                    <p class="mb-1.5 font-medium">
                                        Additional permissions
                                    </p>
                                    <ul
                                        class="max-h-48 list-inside list-disc space-y-0.5 overflow-y-auto text-left text-xs"
                                    >
                                        <li
                                            v-for="p in overflowPermissions"
                                            :key="p"
                                        >
                                            {{ p }}
                                        </li>
                                    </ul>
                                </TooltipContent>
                            </Tooltip>
                        </TooltipProvider>
                    </template>
                    <span v-else class="text-sm text-muted-foreground">
                        No permissions.
                    </span>
                </div>
            </div>
        </div>

        <Form
            v-bind="ProfileController.update.form()"
            class="space-y-6"
            v-slot="{ errors, processing, recentlySuccessful }"
        >
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="grid gap-2">
                    <Label for="first_name">First Name</Label>
                    <Input
                        id="first_name"
                        class="mt-1 block w-full"
                        name="first_name"
                        :default-value="user.first_name"
                        required
                        autocomplete="first_name"
                        placeholder="First name"
                    />
                    <InputError class="mt-2" :message="errors.first_name" />
                </div>
                <div class="grid gap-2">
                    <Label for="last_name">Last Name</Label>
                    <Input
                        id="last_name"
                        class="mt-1 block w-full"
                        name="last_name"
                        :default-value="user.last_name"
                        required
                        autocomplete="last_name"
                        placeholder="Last name"
                    />
                    <InputError class="mt-2" :message="errors.last_name" />
                </div>
            </div>

            <div class="grid gap-2">
                <Label for="email">Email address</Label>
                <Input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    name="email"
                    :default-value="user.email"
                    required
                    autocomplete="username"
                    placeholder="Email address"
                />
                <InputError class="mt-2" :message="errors.email" />
            </div>

            <div v-if="mustVerifyEmail && !user.email_verified_at">
                <p class="-mt-4 text-sm text-muted-foreground">
                    Your email address is unverified.
                    <Link
                        :href="send()"
                        as="button"
                        class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
                    >
                        Click here to resend the verification email.
                    </Link>
                </p>

                <div
                    v-if="status === 'verification-link-sent'"
                    class="mt-2 text-sm font-medium text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <Button :disabled="processing" data-test="update-profile-button"
                    >Save</Button
                >

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-show="recentlySuccessful"
                        class="text-sm text-neutral-600"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </Form>
    </div>

    <DeleteUser />
</template>
