import HomePage from '../page/HomePage';
import SourcePage from '../page/SourcePage';
import AnalyticsPage from '../page/AnalyticsPage';

export const RouteNames = {
  HOME: 'home',
  SOURCE: 'source',
  ANALYTICS: 'analytics'
};

export default [
  {
    path: '/',
    component: HomePage,
    name: RouteNames.HOME,
  },
  {
    path: '/resource/:name',
    component: SourcePage,
    name: RouteNames.SOURCE,
    props: true,
  },
  {
    path: '/analytics',
    component: AnalyticsPage,
    name: RouteNames.ANALYTICS,
    props: true,
  }
];
