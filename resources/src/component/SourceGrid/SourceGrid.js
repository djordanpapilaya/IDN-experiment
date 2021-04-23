import { AbstractTransitionComponent } from 'vue-transition-component';
import SourceGridTransitionController from './SourceGridTransitionController';
import SourceItem from '../SourceItem';
import { mapState } from 'vuex';
import { getValue } from '../../util/injector';
import { GATEWAY } from '../../data/Injectables';

// @vue/component
export default {
  name: 'SourceGrid',
  extends: AbstractTransitionComponent,
  computed: {
    ...mapState({
      resources: state => state.app.resources,
    }),
  },
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
