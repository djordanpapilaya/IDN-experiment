import { AbstractTransitionComponent } from 'vue-transition-component';
import MainHeaderTransitionController from './MainHeaderTransitionController';
import Timer from '../Timer';

// @vue/component
export default {
  name: 'MainHeader',
  extends: AbstractTransitionComponent,
  components: {
    Timer,
  },
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new MainHeaderTransitionController(this);
      this.isReady();
    },
  },
};
