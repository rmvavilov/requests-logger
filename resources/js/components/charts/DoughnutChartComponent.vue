<script>
import {Doughnut} from 'vue-chartjs'

export default {
    name: 'DoughnutChartComponent',

    extends: Doughnut,

    data() {
        return {
            data: {
                labels: [],
                datasets: [
                    {data: [], backgroundColor: [],}
                ]
            },
            options: {
                responsive: true,
            }
        }
    },

    props: {
        // browser, device, platform
        type: {
            type: String,
            default: ''
        },
        dataItems: {
            type: Array,
            default: [],
        }
    },

    methods: {
        randomColor() {
            return '#' + Math.floor(Math.random() * 16777215).toString(16);
        },
        redrawChart() {
            this.resetChartData();

            let data = [],
                backgroundColor = [];

            const that = this;

            _.forEach(this.dataItems, function (dateItem) {
                that.data.labels.push(dateItem.name);
                data.push(dateItem.value);
                backgroundColor.push(that.randomColor());
            });
            this.data.datasets.push({
                data: data,
                backgroundColor: backgroundColor,
            });

            this.renderChart(this.data, this.options);
        },
        resetChartData() {
            this.data.labels = [];
            this.data.datasets = [];
        },
    },

    created() {
        this.$eventBus.$on('redraw_chart', () => {
            this.redrawChart();
        });
    },
}
</script>
