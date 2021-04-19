import HomePage from '../page/HomePage';
import SourcePage from '../page/SourcePage';

export const RouteNames = {
  HOME: 'home',
  SOURCE: 'source',
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
  }
];
