import { AbstractPageTransitionComponent } from 'vue-transition-component';
import HomepageTransitionController from './HomepageTransitionController';
import SourceGrid from '../../component/SourceGrid';

// @vue/component
export default {
  name: 'Homepage',
  extends: AbstractPageTransitionComponent,
  components: {
    SourceGrid,
  },
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new HomepageTransitionController(this);
      this.isReady();
      this.$parent.hasFooter = true;
    },
  },
};
