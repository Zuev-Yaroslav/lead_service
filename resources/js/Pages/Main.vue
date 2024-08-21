<template>
    <Head title="Main"/>
    <MainLayout >
        <div class="bg-white p-4 rounded md:w-1/3 md:mx-auto shadow-md">
            <h3 class="text-3xl text-center mb-4">FORM FOR LEAD</h3>
            <div class="mb-4">
                <label class="block mb-2">First name</label>
                <input v-model="lead.first_name" class="rounded p-2 w-full border-gray-300" placeholder="First name">
                <div v-if="errors.first_name" class="text-red-600 text-xs mx-1 mt-1">{{ errors.first_name[0] }}</div>
            </div>
            <div class="mb-4">
                <label class="block mb-2">Second name</label>
                <input v-model="lead.last_name" class="rounded p-2 w-full border-gray-300" placeholder="Second name">
                <div v-if="errors.last_name" class="text-red-600 text-xs mx-1 mt-1">{{ errors.last_name[0] }}</div>
            </div>
            <div class="mb-4">
                <label class="block mb-2">Email</label>
                <input v-model="lead.email" type="email" class="rounded p-2 w-full border-gray-300" placeholder="Email">
                <div v-if="errors.email" class="text-red-600 text-xs mx-1 mt-1">{{ errors.email[0] }}</div>
            </div>
            <div class="mb-4">
                <label class="block mb-2">Phone</label>
                <input v-model="lead.phone" class="rounded p-2 w-full border-gray-300" placeholder="Phone">
                <div v-if="errors.phone" class="text-red-600 text-xs mx-1 mt-1">{{ errors.phone[0] }}</div>
            </div>
            <div class="mb-4">
                <label class="block mb-2">Message</label>
                <textarea v-model="lead.message" class="rounded p-2 w-full border-gray-300" placeholder="Message"></textarea>
                <div v-if="errors.message" class="text-red-600 text-xs mx-1 mt-1">{{ errors.message[0] }}</div>
            </div>
            <div>
                <a href="#" @click.prevent="storeLead" class="p-3 bg-blue-400 text-xl text-white rounded block text-center hover:bg-blue-500">Send</a>
            </div>
        </div>
    </MainLayout>
</template>

<script>
import {Head} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import {toast} from "vue3-toastify";
export default {
    name: "Main",
    components: {
        MainLayout,
        Head
    },
    data() {
        return {
            lead: {
                first_name: '',
                last_name: '',
                email: '',
                phone: '',
                message: ''
            },
            errors: {}
        }
    },
    methods: {
        storeLead() {
            this.errors = {};
            axios.post(route('leads.store'), this.lead)
                .then(res => {
                    this.lead = {}
                    toast.success('The form has been sent')
                })
                .catch(err => {
                    this.errors = err.response.data.errors
                })
        }
    }
}
</script>

<style scoped>

</style>
