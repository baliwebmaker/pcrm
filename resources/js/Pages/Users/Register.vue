<template>
  <Head title="User Registration" />
    <div class="flex items-center justify-center p-6 min-h-screen bg-indigo-800">
      <div class="w-full max-w-xl">
      <logo class="block mx-auto w-full max-w-xs fill-white" height="50" />
        <div class="md:flex-1 pt-8 md:pt-2 md:overflow-y-auto" scroll-region>
          <flash-messages />
          <slot />
        </div>
      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="store">
        <div class="px-10 py-12">
        <h1 class="text-center text-3xl font-bold">Registration</h1>
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.first_name" :error="form.errors.first_name" class="pr-6 pb-8 w-full lg:w-1/2" label="First name" />
          <text-input v-model="form.last_name" :error="form.errors.last_name" class="pr-6 pb-8 w-full lg:w-1/2" label="Last name" />
          <text-input v-model="form.email" :error="form.errors.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />
          <text-input v-model="form.password" :error="form.errors.password" class="pr-6 pb-8 w-full lg:w-1/2" type="password" autocomplete="new-password" label="Password" />
        </div>
        </div>
        <div class="mt-4 items-center flex justify-between bg-gray-100 border-t border-gray-100"> 
          <a class="px-10 align-baseline font-light tracking-wider text-sm text-500 hover:text-gray-400" href="/login">Already Have a Username? Login!</a>
          <div class="px-10 py-4 ">
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Submit</loading-button>
          </div>
        </div>
      </form>
      </div>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Logo from '@/Shared/Logo'
import TextInput from '@/Shared/TextInput'
import LoadingButton from '@/Shared/LoadingButton'
import FlashMessages from '@/Shared/FlashMessages'

export default {
  metaInfo: { title: 'User Registration' },
  components: {
    Head,
    FlashMessages,
    LoadingButton,
    Logo,
    TextInput,
  },
  data() {
    return {
      form: this.$inertia.form({
        first_name: null,
        last_name: null,
        email: null,
        password: null,
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/registrations', {
        onSuccess: () => this.form.reset('first_name','last_name','password', 'email'),
      })
    },
  },
}
</script>
