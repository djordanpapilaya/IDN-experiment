import { AbstractTransitionComponent } from 'vue-transition-component';
import VueTypes from 'vue-types';
import SourceHeaderTransitionController from './SourceHeaderTransitionController';

// @vue/component
export default {
  name: 'SourceHeader',
  extends: AbstractTransitionComponent,
  props: {
    data: VueTypes.any.isRequired,
  },
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new SourceHeaderTransitionController(this);
      this.isReady();
    },
  },
};
