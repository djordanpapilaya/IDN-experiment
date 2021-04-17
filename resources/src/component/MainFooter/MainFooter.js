import { AbstractTransitionComponent } from 'vue-transition-component';
import MainFooterTransitionController from './MainFooterTransitionController';

// @vue/component
export default {
  name: 'MainFooter',
  extends: AbstractTransitionComponent,
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new MainFooterTransitionController(this);
      this.isReady();
    },
  },
};
