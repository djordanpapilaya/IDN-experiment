import { AbstractPageTransitionComponent } from 'vue-transition-component';
import HomepageTransitionController from './HomepageTransitionController';

// @vue/component
export default {
  name: 'Homepage',
  extends: AbstractPageTransitionComponent,
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new HomepageTransitionController(this);
      this.isReady();
    },
  },
};
