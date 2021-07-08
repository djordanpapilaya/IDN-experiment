import { AbstractPageTransitionComponent } from 'vue-transition-component';
import AnalyticsPageTransitionController from './AnalyticsPageTransitionController';
import { getValue } from '../../util/injector';
import { GATEWAY } from '../../data/Injectables';

// @vue/component
export default {
  name: 'AnalyticsPage',
  data() {
    return {
      users: '',
      dataReady: false,
      chartAvailable: false,
      selectedUser: 0,
      user: '',
      political: [],
      politicalKeys: [],
      complexity: [],
      complexityKeys: [],
      types: [],
      typesKeys: [],
      typesFull: [],
      complexityFull: [],
      options: {
        chart: {
          type: 'line',
          height: 350
        },
        stroke: {
          curve: 'stepline',
        },
        xaxis: {
          categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998],
          type: 'numeric',
          decimalsInFloat: 4,
          // min: 0,
          // max: 1,
          tickAmount: 'dataPoints',
          tickPlacement: 'on'

        },
        dataLabels: {
          enabled: true,
          formatter: function (value, { seriesIndex, dataPointIndex, w }) {
            if (value === -1) {
              return 'C';
            }
            if (value === 0) {
              return 'M';
            }
            if (value === 1) {
              return 'P';
            }
          }
        },
        title: {
          text: 'Political graph',
          align: 'left'
        },
        markers: {
          hover: {
            sizeOffset: 2
          }
        }
      },
      optionsType: {
        chart: {
          type: 'line',
          height: 350
        },
        stroke: {
          curve: 'stepline',
        },
        xaxis: {
          categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998],
          type: 'numeric',
          decimalsInFloat: 4,
          // min: 0,
          // max: 1,
          tickAmount: 'dataPoints',
          tickPlacement: 'on',

        },
        dataLabels: {
          enabled: true,
          formatter: function (value, { seriesIndex, dataPointIndex, w }) {
            if (value === 1) {
              return 'V';
            }
            if (value === 0) {
              return 'A';
            }
            if (value === -1) {
              return 'T';
            }
          }
        },
        title: {
          text: 'Type graph',
          align: 'left'
        },
        markers: {
          hover: {
            sizeOffset: 2
          }
        }
      },
      optionsComplexity: {
        chart: {
          type: 'line',
          height: 350
        },
        stroke: {
          curve: 'stepline',
        },
        xaxis: {
          categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998],
          type: 'numeric',
          decimalsInFloat: 4,
          // min: 0,
          // max: 1,
          tickAmount: 'dataPoints',
          tickPlacement: 'on'

        },
        dataLabels: {
          enabled: true,
          formatter: function (value, { seriesIndex, dataPointIndex, w }) {
            if (value === -1) {
              return 'S';
            }
            if (value === 0) {
              return 'M';
            }
            if (value === 1) {
              return 'C';
            }
          }
        },
        title: {
          text: 'Complexity graph',
          align: 'left'
        },
        markers: {
          showNullDataPoints: true,
          hover: {
            sizeOffset: 2
          }
        }
      },
      series: [{
        name: 'series-1',
        data: []
      }],
      seriesType: [{
        name: 'series-1',
        data: []
      }],
      seriesComplexity: [{
        name: 'series-1',
        data: []
      }],
      seriesHeatmap: [
        {
          name: 'Media types',
          data: [{
            x: 'W1',
            y: 43
          }, {
            x: 'W2',
            y: 43
          }, {
            x: 'W3',
            y: 43
          }, {
            x: 'W4',
            y: 43
          }]
        }
      ],
      optionsHeatmap: {
        plotOptions: {
          heatmap: {
            colorScale: {
              // custom color range
              ranges: [{
                from: '-1',
                to: '-1',
                color: '#00A100',
                name: 'Simple',
              },
                {
                  from: '0',
                  to: '0',
                  color: '#FFB200',
                  name: 'Medium',
                },
                {
                  from: '1',
                  to: '1',
                  color: '#128FD9',
                  name: 'Complex',
                }],
            },
          },
        },
        dataLabels: {
          enabled: true
        },
        xaxis: {
          type: 'numeric',
        },
        title: {
          text: 'Heatmap for media types with their complexity levels'
        },
      },
    };
  },
  extends: AbstractPageTransitionComponent,
  mounted() {
    this.getUser();
  },
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new AnalyticsPageTransitionController(this);
      this.isReady();
    },
    getUser() {
      const gateway = getValue(GATEWAY);

      gateway.get('analytics/all').then((result) => {
        this.users = result.data.users;
        this.dataReady = true;
      });
    },
    getUserData() {
      const gateway = getValue(GATEWAY);

      this.political = [];
      this.politicalKeys = [];
      this.complexity = [];
      this.complexityKeys = [];
      this.types = [];
      this.typesKeys = [];

      gateway.get('analytics/user/' + this.selectedUser).then((result) => {
        this.user = result.data;

        this.user.all.paths.complexity_relative.forEach((item) => {
          this.complexity.push(item[Object.keys(item)[0]]);

          switch (Object.keys(item)[0]) {
            case 'S':
              this.complexityKeys.push(-1);
              break;
            case 'M':
              this.complexityKeys.push(0);
              break;
            case 'C':
              this.complexityKeys.push(1);
              break;
          }
        });

        this.user.all.paths.type_relative.forEach((item) => {
          this.types.push(item[Object.keys(item)[0]]);

          switch (Object.keys(item)[0]) {
            case 'V':
              this.typesKeys.push(1);
              break;
            case 'T':
              this.typesKeys.push(-1);
              break;
            case 'A':
              this.typesKeys.push(0);
              break;
          }
        });

        this.user.all.paths.political_relative.forEach((item) => {
          this.political.push(item[Object.keys(item)[0]]);

          switch (Object.keys(item)[0]) {
            case 'P':
              this.politicalKeys.push(1);
              break;
            case 'M':
              this.politicalKeys.push(0);
              break;
            case 'C':
              this.politicalKeys.push(-1);
              break;
          }
        });

        this.complexityFull = this.user.all.paths.complexity.split('-');
        const complex = this.complexityFull.pop();
        console.log(this.user.all.paths);
        this.typesFull = this.user.all.paths.type.split('-');
        const type = this.typesFull.pop();

        let tempComplexArray = [];
        let heatmapArray = [];

        this.complexityFull.forEach((item) => {
          switch (item) {
            case 'S':
              tempComplexArray.push(-1);
              break;
            case 'M':
              tempComplexArray.push(0);
              break;
            case 'C':
              tempComplexArray.push(1);
              break;
          }
        });

        this.complexityFull = tempComplexArray;

        this.complexityFull.forEach((item, index) => {
          const temp = {
            x: this.typesFull[index],
            y: this.complexityFull[index],
          };

          heatmapArray.push(temp);
        });

        this.seriesHeatmap[0].data = heatmapArray;

        this.options.xaxis.categories = this.political;
        this.series[0].data = this.politicalKeys;

        this.optionsType.xaxis.categories = this.types;
        this.seriesType[0].data = this.typesKeys;

        this.optionsComplexity.xaxis.categories = this.complexity;
        this.seriesComplexity[0].data = this.complexityKeys;

        this.chartAvailable = true;

        this.$refs.polical.updateSeries(this.series);
        this.$refs.polical.updateOptions(this.options);
        this.$refs.type.updateSeries(this.seriesType);
        this.$refs.type.updateOptions(this.optionsType);
        this.$refs.complexity.updateSeries(this.seriesComplexity);
        this.$refs.complexity.updateOptions(this.optionsComplexity);
        this.$refs.heatmap.updateSeries(this.seriesHeatmap);
        this.$refs.heatmap.updateOptions(this.plotOptions);
      });
    }
  },
};
