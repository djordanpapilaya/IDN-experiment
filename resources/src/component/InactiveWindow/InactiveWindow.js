import { AbstractTransitionComponent } from 'vue-transition-component';
import InactiveWindowTransitionController from './InactiveWindowTransitionController';

// @vue/component
export default {
  name: 'InactiveWindow',
  extends: AbstractTransitionComponent,
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new InactiveWindowTransitionController(this);
      this.isReady();
    },
    handleLogout() {
      window.location.href = '/logout';
    },
    handleCancel() {
      this.$emit('cancel');
    },
  },
};
