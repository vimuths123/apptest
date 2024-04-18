<template>
  <AppLayout>
    <Container>
      <div class="container mx-auto px-4 sm:px-8">
          <div class="py-8">
              <div class="flex justify-between pb-4">
                  <div>
                      <span class="text-xs">Prease press enter after type..</span>
                      <input 
                        v-model="search"
                        @keyup.enter="searchMethod"
                      type="text" placeholder="Search by last name..." class="block w-full pl-5 pr-12 sm:text-sm border-gray-300 rounded-md shadow-sm">
                  </div>
                  <div>
                      <Link :href="route('members.create')" class="bg-gray-800 text-white font-bold py-2 px-4 rounded">
                          Add New Member
                      </Link>
                  </div>
              </div>

              <div class="shadow-md rounded-lg border border-gray-300">
                  <table class="min-w-full bg-white">
                      <thead class="bg-gray-50">
                          <tr>
                              <th class="text-left py-3 px-4 uppercase font-semibold text-sm border-b border-gray-200">First Name</th>
                              <th class="text-left py-3 px-4 uppercase font-semibold text-sm border-b border-gray-200">Last Name</th>
                              <th class="text-left py-3 px-4 uppercase font-semibold text-sm border-b border-gray-200">Date of Birth</th>
                              <th class="text-left py-3 px-4 uppercase font-semibold text-sm border-b border-gray-200">Actions</th>
                          </tr>
                      </thead>
                      <tbody class="text-gray-700">
                          <tr v-for="member in members.data" :key="member.id">
                              <td class="text-left py-3 px-4">{{ member.first_name }}</td>
                              <td class="text-left py-3 px-4">
                                <!-- {{ member.last_name }} -->
                                {{ member.last_name }} {{ member.summary === 'ACCURA' ? 'ACCURA' : '' }}  
                              </td>
                              <td class="text-left py-3 px-4">{{ member.date_of_birth }}</td>
                              <td class="text-left py-3 px-4">
                                  <Link :href="route('members.edit', member.id)" class="bg-gray-800 text-white py-1 px-2 rounded mr-2 mb-2">Edit</Link>
                                  <button @click="deleteMember(member.id)" class="bg-red-700 hover:bg-red-900 text-white py-1 px-2 rounded">Delete</button>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>

              <Pagination :meta="members.meta" />
              <ConfirmationModalWrapper />
          </div>
      </div>
    </Container>
  </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import Pagination from "@/Components/Pagination.vue";
import { ref } from "vue";
import { router } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3';
import ConfirmationModalWrapper from '@/Components/ConfirmationModalWrapper.vue';
import {useConfirm} from "@/Utilities/Composables/useConfirm.js";


const props = defineProps({
  members: Object,
  initialSearch: String
});

const search = ref(props.initialSearch || '');

function searchMethod() {
  router.get('/members', { search: search.value }, {
    preserveState: true,
    preserveScroll: true,
    replace: true
  });
}

const { confirmation } = useConfirm();

const deleteMember = async (memberId) => {
  if (! await confirmation('Are you sure you want to delete this member?')) {
        return;
  }

  router.delete(route('members.destroy', 
  { member: memberId }), {
    preserveScroll: true
  });
}
</script>
