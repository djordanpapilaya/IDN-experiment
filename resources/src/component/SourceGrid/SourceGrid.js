import { AbstractTransitionComponent } from 'vue-transition-component';
import SourceGridTransitionController from './SourceGridTransitionController';
import SourceItem from '../SourceItem';

// @vue/component
export default {
  name: 'SourceGrid',
  extends: AbstractTransitionComponent,
  components: {
    SourceItem,
  },
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new SourceGridTransitionController(this);
      this.isReady();
    },
  },
};
