<template>
  <div>
    <Head title="Permissions" />
    <h1 class="mb-8 font-bold text-3xl">Permissions</h1>
    <div class="mb-6 flex justify-between items-center">
        <Link class="btn-indigo" href="/permissions/create">
            <span>Create</span>
            <span class="hidden md:inline">Permissions</span>
        </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">Id</th>
          <th class="px-6 pt-6 pb-4">Name</th>
          <th class="px-6 pt-6 pb-4">Guard Name</th>
        </tr>
        <tr v-for="permission in permissions" :key="permission.id" 
        class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="px-6 py-4 flex items-center" 
            :href="`/permissions/${permission.id}/edit`" tabindex="-1">
              {{ permission.id }}
            </Link>
          </td>          
          <td class="border-t">
            <Link class="px-6 py-4 flex items-center" 
            :href="`/permissions/${permission.id}/edit`" tabindex="-1">
              {{ permission.name }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="px-6 py-4 flex items-center" 
            :href="`/permissions/${permission.id}/edit`" tabindex="-1">
              {{ permission.guard_name }}
            </Link>
          </td>
          <td class="border-t w-px">
            <Link class="px-4 flex items-center" 
            :href="`/permissions/${permission.id}/edit`" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>
        <tr v-if="permissions.length === 0">
          <td class="border-t px-6 py-4" colspan="4">No permissions found.</td>
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
        title: 'Permissions'
    },
    components: {
      Head,
      Icon,
      Link,
    },
    props: {
        permissions: Array,
    },
    layout: Layout,

}

</script>