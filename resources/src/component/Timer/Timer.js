import { AbstractTransitionComponent } from 'vue-transition-component';
import TimerTransitionController from './TimerTransitionController';

// @vue/component
export default {
  name: 'Timer',
  extends: AbstractTransitionComponent,
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new TimerTransitionController(this);
      this.isReady();
    },
  },
};
