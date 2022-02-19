<template>
<div>
    <Head title="Roles" />
    <h1 class="mb-8 font-bold text-3xl">Roles</h1>
    <div class="mb-6 flex justify-between items-center">
        <Link class="btn-indigo" href="/roles/create">
            <span>Create</span><span class="hidden md:inline">Role</span>
        </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <tr class="text-left font-bold">
                <th class="px-6 pt-6 pb-4">Id</th>
                <th class="px-6 pt-6 pb-4">Roles</th>
                <th class="px-6 pt-6 pb-4">Permissions</th>
                <th class="px-6 pt-6 pb-4">Guard Name</th>
            </tr>
            <tr v-for="role in roles"  :key="role.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                <td class="border-t">
                    <Link
                        :href="`/roles/${role.id}/edit`"
                        class="px-6 py-4 flex items-center" 
                        tabindex="-1"
                    >
                    {{role.id}}
                    </Link>
                </td>
                <td class="border-t">
                    <Link
                        :href="`/roles/${role.id}/edit`"
                        class="px-6 py-4 flex items-center" 
                        tabindex="-1"
                    >
                    {{role.name}}
                    </Link>
                </td>
                <td class="border-t">
                    <span
                        v-for="assignedPermission in role.assignedPermissions"
                        :key="assignedPermission.id"
                        :value="assignedPermission.name"
                        class="inline-block items-center justify-center px-2 py-1 mr-2 mb-2 text-xs text-white font-bold leading-none bg-red-600 rounded-full"
                    >
                    {{assignedPermission.name}}
                    </span>
                </td>
                <td class="border-t">
                    <Link
                        :href="`/roles/${role.id}/edit`"
                        class="px-6 py-4 flex items-center" 
                        tabindex="-1"
                    >
                    {{role.guard_name}}
                    </Link>
                </td>
                <tr v-if="roles.length === 0">
                    <td class="border-t px-6 py-4" colspan="4">No Roles found.</td>
                </tr>
            </tr>
        </table>
    </div>
</div>
</template>
<script>
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Icon from '@/Shared/Icon'
    import pickBy from 'lodash/pickBy'
    import Layout from '@/Shared/Layout'
    import throttle from 'lodash/throttle'
    import mapValues from 'lodash/mapValues'

export default {
    metaInfo: {
        title: 'Roles'
    },
    components:{
    Head,
    Link,
    Icon,
    },
    props: {
        roles: Array,
    },
    layout: Layout,
    
}
</script>
