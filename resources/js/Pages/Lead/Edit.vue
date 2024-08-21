<template>
    <Head title="Edit lead"/>
    <MainLayout >
        <div class="bg-white p-4 rounded xl:w-3/4 xl:mx-auto mx-3 min-h-screen shadow-md">
            <h3 class="text-3xl mb-6">Edit lead</h3>
            <div class="mb-4">
                <label class="block mb-2">First name</label>
                <input @input="hasChange" v-model="lead.first_name" class="w-1/3 rounded p-2 border-gray-300" placeholder="First name">
                <div v-if="errors.first_name" class="text-red-600 text-xs mx-1 mt-1">{{ errors.first_name[0] }}</div>
            </div>
            <div class="mb-4">
                <label class="block mb-2">Second name</label>
                <input @input="hasChange" v-model="lead.last_name" class="w-1/3 rounded p-2 border-gray-300" placeholder="Second name">
                <div v-if="errors.last_name" class="text-red-600 text-xs mx-1 mt-1">{{ errors.last_name[0] }}</div>
            </div>
            <div class="mb-4">
                <label class="block mb-2">Email</label>
                <input @input="hasChange" v-model="lead.email" type="email" class="w-1/3 rounded p-2 border-gray-300" placeholder="Email">
                <div v-if="errors.email" class="text-red-600 text-xs mx-1 mt-1">{{ errors.email[0] }}</div>
            </div>
            <div class="mb-4">
                <label class="block mb-2">Phone</label>
                <input @input="hasChange" v-model="lead.phone" class="w-1/3 rounded p-2 border-gray-300" placeholder="Phone">
                <div v-if="errors.phone" class="text-red-600 text-xs mx-1 mt-1">{{ errors.phone[0] }}</div>
            </div>
            <div class="mb-4">
                <label class="block mb-2">Status</label>
                <select @change="hasChange" v-model="lead.status_id" class="py-1 rounded border-gray-300">
                    <option v-for="status in statuses" :value="status.id">{{status.title}}</option>
                </select>
                <div v-if="errors.phone" class="text-red-600 text-xs mx-1 mt-1">{{ errors.phone[0] }}</div>
            </div>
            <div class="mb-4">
                <label class="block mb-2">Message</label>
                <textarea @input="hasChange" v-model="lead.message" class="w-1/3 rounded p-2 border-gray-300" placeholder="Message"></textarea>
                <div v-if="errors.message" class="text-red-600 text-xs mx-1 mt-1">{{ errors.message[0] }}</div>
            </div>
            <div>
                <button :disabled="!isAllowSave" @click.prevent="updateLead(lead.id)" :class="(isAllowSave) ? 'hover:bg-blue-500 bg-blue-400' : 'bg-blue-300'" class="p-3 text-xl text-white rounded text-center">Save</button>
            </div>
        </div>
    </MainLayout>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {toast} from "vue3-toastify";
import {Head} from "@inertiajs/vue3";
export default {
    name: "Main",
    components: {
        Head,
        MainLayout
    },
    props: {
        lead: Object,
        statuses: Array
    },
    data() {
        return {
            errors: {},
            baseLead: JSON.stringify(this.lead),
            isAllowSave: false
        }
    },
    methods: {
        updateLead(id) {
            this.errors = {}
            axios.patch(route('leads.update', id), this.lead)
                .then(res => {
                    toast.success('The data is saved')
                    this.baseLead = JSON.stringify(res.data)
                    this.hasChange();
                })
                .catch(err => {
                    this.errors = err.response.data.errors
                })
        },
        hasChange() {
            this.isAllowSave = this.baseLead !== JSON.stringify(this.lead)
        }

    }
}
</script>

<style scoped>

</style>
