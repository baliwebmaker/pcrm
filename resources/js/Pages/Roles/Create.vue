<template>
    <div>
        <Head title="Create Role" />
        <h1 class="mb-8 font-bold text-3xl">
        <Link 
        href="/roles"
        class="text-indigo-400 hover:text-indigo-600"
        >
        Roles
        </Link>
        </h1>
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <form @submit.prevent="store">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <text-input v-model="form.name" :error="form.errors.name" 
                    class="pr-6 pb-8 w-full lg:w-1/2" label="Name" />
                    <text-input v-model="form.guard_name" :error="form.errors.guard_name" 
                    class="pr-6 pb-8 w-full lg:w-1/2" label="Guard Name" />
                    <label class="block w-full">Permissions:</label>
                    <span v-for="assignedPermission in assignedPermissions"
                    :key="assignedPermission.id"
                    :value="assignedPermission.name"
                    @click="unassignPermission(assignedPermission)"
                    class="inline-flex items-center justify-center px-2 py-1 mr-2 mt-2 mb-2 text-xs text-white font-bold leading-none bg-red-600 rounded-full" 
                    >
                    {{ assignedPermission.name }} x
                    </span>
                </div>
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <h3 class="block font-bold w-full">Available Permissions </h3>
                    <span 
                        v-for="unassignedPermission in unassignedPermissions" 
                        :key="unassignedPermission.id"
                        :value="unassignedPermission.name"
                        @click="assignPermission(unassignedPermission)"
                        class="inline-flex items-center justify-center px-2 py-1 mr-2 mt-2 mb-2 text-xs text-white font-bold leading-none bg-indigo-600 rounded-full"
                    >
                    {{unassignedPermission.name}} +
                    </span>
                </div>
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                    <loading-button 
                    :loading="form.processing" 
                    class="btn-indigo" type="submit">
                    Create Role
                    </loading-button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
    import Layout from '@/Shared/Layout'
    import FileInput from '@/Shared/FileInput'
    import TextInput from '@/Shared/TextInput'
    import SelectInput from '@/Shared/SelectInput'
    import LoadingButton from '@/Shared/LoadingButton'

    import assignPermission from '@/Mixins/assignPermission'

export default {
    metaInfo: {
            title: 'Create Role'
    },
    mixins:[assignPermission],
    components: {
            FileInput,
            Head,
            Link,
            LoadingButton,
            SelectInput,
            TextInput,
    },
    layout: Layout,
    remember: 'form',
    props: {
        unassignedPermissions:Array,
        assignedPermissions:Array,
    },

    data() {
        return{
            form: this.$inertia.form({
                name: null, 
                guard_name: null,
            })
        }
    },
    methods: {
        store() { 
            this.form.post( `/roles/${JSON.stringify(this.assignedPermissions)}`)
        }
    },

}
</script>
