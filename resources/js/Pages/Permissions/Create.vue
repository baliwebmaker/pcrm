<template>
<div>
    <Head title="Create Permissions" />
    <div class="mb-8 flex justify-start max-w-3xl">
    <h1 class="font-bold text-3xl">
        <Link class="text-indigo-400 hover:text-indigo-600" 
        href="/permissions">
        Permissions
        </Link>

    </h1>
    </div>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
    <form @submit.prevent="store">
    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
        <text-input v-model="form.name"  
        :error="form.errors.name" class="pr-6 pb-8 w-full lg:w-1/2" 
        label="Name" />
        <text-input v-model="form.guard_name"  
        :error="form.errors.guard_name" class="pr-6 pb-8 w-full lg:w-1/2" 
        label="Guard Name" />
    </div>
    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
        <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Permission</loading-button>
    </div>

    </form>
    </div>

</div>
</template>
<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
    metaInfo: {
        title: 'Create Permission'
    },
    components: {
        Head,
        Link,
        LoadingButton,
        TextInput,
    },
    layout: Layout,
    remember: 'form',
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                guard_name: null,
            }),
        }
    },
    methods: {
        store() {
            this.form.post('/permissions')
        }
    },
}

</script>