<template>
    <div class="card">
        <div class="card-header">
            <slot></slot>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" :class="{active : currentTab === 0}" aria-current="page"
                       @click="currentTab = 0">All time</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{active : currentTab === 1}" @click="currentTab = 1">Today</a>
                </li>
            </ul>

            <template v-if="isFetching">
                <div class="spinner-border text-primary" role="status"></div>
            </template>
            <template v-else>
                <doughnut-chart-component v-show="currentTab === 0" :type="type" :data-items="data.all">
                    <slot></slot>
                </doughnut-chart-component>
                <doughnut-chart-component v-show="currentTab === 1" :type="type" :data-items="data.today">
                    <slot></slot>
                </doughnut-chart-component>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ChartWrapComponent',

    data() {
        return {
            currentTab: 0,
        }
    },

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
            type: Object,
            default: {
                all: [],
                today: [],
            },
        }
    }
}
</script>

<style>
.nav-item:hover {
    cursor: pointer;
}
</style>
