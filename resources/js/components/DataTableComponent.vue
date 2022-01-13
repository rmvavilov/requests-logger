<template>
    <div class="card">
        <div class="card-header">Users requests</div>
        <div class="card-body">
            <template v-if="isFetching">
                <div class="spinner-border text-primary" role="status"></div>
            </template>
            <template v-else>
                <datatable class="w-100" :columns="requests.columns" :data="requests.rows"></datatable>
            </template>
        </div>
    </div>
</template>

<script>

export default {
    name: 'DataTableComponent',

    data() {
        return {
            isFetching: false,
            requests: {
                columns: [
                    {label: 'ID', field: 'id'},
                    {label: 'User id', field: 'user_id'},
                    {label: 'IP', field: 'ip'},
                    {label: 'User Agent ID', field: 'user_agent_id'},
                    {label: 'Browser', field: 'user_agent.browser'},
                    {label: 'Platform', field: 'user_agent.platform'},
                    {label: 'Device', field: 'user_agent.device'},
                    {label: 'Device type', field: 'user_agent.device_type'},
                    {label: 'Created at', field: 'created_at'},
                ],
                rows: []
            }
        }
    },

    methods: {
        fetchAllData() {
            this.isFetching = true;
            this.fetchRequests();
        },
        fetchRequests() {
            this.requests.rows = [];

            axios({
                method: 'get',
                url: '/statistics/requests',
            }).then(response => {
                this.requests.rows = _.get(response, 'data.requests', []);
                this.isFetching = false;
            })
        },
    },

    mounted() {
        this.fetchAllData();
    },
}
</script>
