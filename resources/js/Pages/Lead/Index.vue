<template>
    <Head title="Leads"/>
    <MainLayout>
        <div class="bg-white p-4 rounded xl:w-3/4 xl:mx-auto mx-3 min-h-screen shadow-md">
            <h3 class="text-3xl mb-6">Leads</h3>
            <div>Total: {{ leadsData.meta.total_quantity }}</div>
            <div>Number of leads by status:</div>
            <div class="flex justify-start w-1/4 gap-3 text-nowrap">
                <div>New: {{ leadsData.meta.quantity.new }}</div>
                <div>At work: {{ leadsData.meta.quantity.at_work }}</div>
                <div>Completed: {{ leadsData.meta.quantity.completed }}</div>
            </div>
            <div class="overflow-y-auto">
                <table class="table-auto w-full border-collapse">
                    <thead class="text-left text-nowrap border-b border-gray-400">
                        <tr>
                            <th class="p-3">ID</th>
                            <th class="p-3">First Name</th>
                            <th class="p-3">Last Name</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Phone</th>
                            <th class="p-3">Created At</th>
                            <th class="p-3">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="lead in leadsData.data" class="border-b border-gray-300">
                            <td class="p-3">{{ lead.id }}</td>
                            <td class="p-3">{{ lead.first_name }}</td>
                            <td class="p-3">{{ lead.last_name }}</td>
                            <td class="p-3">{{ lead.email }}</td>
                            <td class="p-3">{{ lead.phone }}</td>
                            <td class="p-3">{{ new Date(lead.created_at).toLocaleString() }}</td>
                            <td class="p-3">
                                <select @change="updateLeadStatus(lead.id, lead.status_id)" v-model="lead.status_id" class="py-1 rounded border-gray-300">
                                    <option v-for="status in statuses" :value="status.id">{{status.title}}</option>
                                </select>
                            </td>
                            <td class="p-3">
                                <Link :href="route('leads.edit', lead.id)" class="p-2 bg-green-400 text-white rounded block text-center hover:bg-green-500">Edit</Link>
                            </td>
                            <td class="p-3">
                                <a href="#" @click.prevent="destroyLead(lead.id)" class="p-2 bg-red-400 text-white rounded block text-center hover:bg-red-500">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
<!--                <div v-if="leadsData.length > 0" v-for="lead in leadsData" class="flex justify-between border-gray-200 border-b p-3 gap-2">-->

<!--                </div>-->
            </div>

        </div>
    </MainLayout>
</template>
<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Head, Link} from "@inertiajs/vue3";
import {toast} from "vue3-toastify";
export default {
    name: "Index",
    components: {
        MainLayout,
        Link,
        Head
    },
    data() {
        return {
            leadsData: this.leads
        }
    },
    props: {
        leads: Object,
        statuses: Array
    },
    methods: {
        getLeads() {
            axios.get(route('leads.index'))
                .then(res => {
                    this.leadsData = res.data;
                })
        },
        updateLeadStatus(id, status_id) {
            axios.patch(route('leads.update_status', id), {status_id})
                .then(res => {
                    toast.success('Is saved', {
                        autoClose: 2000
                    })
                    this.getLeads()
                });
        },
        destroyLead(id) {
            axios.delete(route('leads.destroy', id))
                .then(res => {
                    this.getLeads()
                });
        }
    }
}
</script>
<style scoped>

</style>
