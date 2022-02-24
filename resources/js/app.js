require('./bootstrap');

const $ = require("startbootstrap-sb-admin-2/vendor/jquery/jquery.js");

require('startbootstrap-sb-admin-2/vendor/jquery-easing/jquery.easing.js')($);

require('startbootstrap-sb-admin-2/js/sb-admin-2.js');

const {
  Chart,
  ArcElement,
  LineElement,
  BarElement,
  PointElement,
  BarController,
  BubbleController,
  DoughnutController,
  LineController,
  PieController,
  PolarAreaController,
  RadarController,
  ScatterController,
  CategoryScale,
  LinearScale,
  LogarithmicScale,
  RadialLinearScale,
  TimeScale,
  TimeSeriesScale,
  Decimation,
  Filler,
  Legend,
  Title,
  Tooltip,
  SubTitle
} = require('startbootstrap-sb-admin-2/vendor/chart.js/Chart.js');

Chart.register(
  ArcElement,
  LineElement,
  BarElement,
  PointElement,
  BarController,
  BubbleController,
  DoughnutController,
  LineController,
  PieController,
  PolarAreaController,
  RadarController,
  ScatterController,
  CategoryScale,
  LinearScale,
  LogarithmicScale,
  RadialLinearScale,
  TimeScale,
  TimeSeriesScale,
  Decimation,
  Filler,
  Legend,
  Title,
  Tooltip,
  SubTitle
);

require('startbootstrap-sb-admin-2/js/demo/chart-area-demo.js');
require('startbootstrap-sb-admin-2/js/demo/chart-pie-demo.js');