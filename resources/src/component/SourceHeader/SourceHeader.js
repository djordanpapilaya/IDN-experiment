import { AbstractTransitionComponent } from 'vue-transition-component';
import SourceHeaderTransitionController from './SourceHeaderTransitionController';

// @vue/component
export default {
  name: 'SourceHeader',
  extends: AbstractTransitionComponent,
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new SourceHeaderTransitionController(this);
      this.isReady();
    },
  },
};
