<template>
  <AppLayout>
    <Container>
        <form @submit.prevent="updateMember" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="flex mb-4">
                <div class="w-1/2 mr-2">
                    <InputLabel for="title" class="block text-gray-700 text-sm font-bold mb-2">First Name</InputLabel>
                    <TextInput id="title" class="w-full" v-model="form.first_name" placeholder="First Name" />
                    <InputError :message="form.errors.first_name" class="mt-1" />
                </div>
                <div class="w-1/2 ml-2">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="ds_division">
                    DS Division
                </label>

                <select v-model="form.ds_division" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" id="ds_division">
                    <option value="">Select a Division</option>
                    <option value="colombo_1">Colombo 1</option>
                    <option value="colombo_2">Colombo 2</option>
                    <option value="colombo_3">Colombo 3</option>
                </select>
                <InputError :message="form.errors.ds_division" class="mt-1" />
                </div>
            </div>

            <div class="flex mb-4">
                <div class="w-1/2 mr-2">
                    <InputLabel for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Last Name</InputLabel>
                    <TextInput id="last_name" class="w-full" v-model="form.last_name" placeholder="First Name" />
                    <InputError :message="form.errors.last_name" class="mt-1" />
                </div> 
                <div class="w-1/2 ml-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="date_of_birth">
                        Date of Birth
                    </label>
                    <input v-model="form.date_of_birth" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date_of_birth" type="date">
                    <InputError :message="form.errors.date_of_birth" class="mt-1" />
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="summary">
                    Summary
                </label>
                <textarea v-model="form.summary" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="summary" placeholder="Enter a summary"></textarea>
            </div>

            <div class="flex items-center justify-between pt-4">
                <Link :href="route('members.index')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Back
                </Link>
                <div>
                    <button @click="resetForm" class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-900 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition mr-2" type="button">
                        Reset
                    </button>
                    <PrimaryButton class="bg-green-700 hover:bg-green-900" type="submit">Save</PrimaryButton>
                </div>
            </div>
        </form>
    </Container>
  </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DropDown from "@/Components/Dropdown.vue";
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  member: Object
});

const form = useForm({
    id: props.member.id, 
    first_name: props.member.first_name,
    last_name: props.member.last_name,
    date_of_birth: props.member.date_of_birth,
    summary: props.member.summary,
    ds_division: props.member.ds_division
});

const updateMember = () => form.put(route('members.update', { member: form.id }));

const resetForm = () => form.reset();


</script>
