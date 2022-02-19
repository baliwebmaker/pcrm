<template>
    <div>
        <Head :title="`${form.name}`" />
        <div class="mb-8 flex justify-start max-w-3xl">
            <h1 class="font-bold text-3xl">
            <Link 
            href="/roles"
            class="text-indigo-400 hover:text-indigo-600"
            >
            Roles
            </Link>
            <span class="text-indigo-400 font-medium">/</span>
            {{form.name}}
            </h1>
        </div>
        <trashed-message v-if="role.deleted_at" class="mb-6">
            This role has been deleted.
        </trashed-message>
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <form @submit.prevent="update">
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
                    <button 
                    v-if="!role.deleted_at"
                    @click="destroy"
                    type="button"
                    class="text-red-600 hover:underline"
                    tabindex="-1"
                    >
                    Delete Role
                    </button>
                    <loading-button 
                    :loading="form.processing" 
                    class="btn-indigo ml-auto" type="submit">
                    Update Role
                    </loading-button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import { Head, Link } from '@inertiajs/inertia-vue3'

import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import FileInput from '@/Shared/FileInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

import assignPermission from '@/Mixins/assignPermission'

export default {
    metaInfo(){
       return{
           title: `${this.form.name}`
       } 
    },
    mixins: [assignPermission],
    components: {
        Head,
        Link,
        FileInput,
        LoadingButton,
        SelectInput,
        TextInput,
        TrashedMessage,
    },
    layout: Layout,
    remember: 'form',
    props: {
        role: Object, 
        unassignedPermissions:Array,
        assignedPermissions:Array,
    },
    data() {
        return{
            form: this.$inertia.form({
                _method: 'put',
                name: this.role.name, 
                guard_name: this.role.guard_name,
            })
        }
    },
    methods:{
        update(){
            this.form.post(`/roles/${this.role.id}/${JSON.stringify(this.assignedPermissions)}`)
        },
        destroy(){
            if (confirm('Are you sure you want to delete this role?')){
               this.$inertia.delete(`/roles/${this.role.id}`)
            }
        },
    },
}
</script>
