<template>
    <div class="card">
        <div class="card-header">
            <slot></slot>
        </div>
        <div class="card-body">
            <template v-if="isFetching">
                <div class="spinner-border text-primary" role="status"></div>
            </template>
            <template v-else>
                <doughnut-chart-component :type="type" :data-items="data">
                    <slot></slot>
                </doughnut-chart-component>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ChartWrapComponent',

    props: {
        isFetching: {
            type: Boolean,
            default: false,
        },
        // browser, device, platform
        type: {
            type: String
        },
        data: {
            type: Array,
            default: [],
        }
    }
}
</script>
