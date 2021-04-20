import { AbstractPageTransitionComponent } from 'vue-transition-component';
import SourcePageTransitionController from './SourcePageTransitionController';
import SourceHeader from '../../component/SourceHeader';
import AudioPlayer from '../../component/AudioPlayer';
import VideoPlayer from '../../component/VideoPlayer';

// @vue/component
export default {
  name: 'SourcePage',
  extends: AbstractPageTransitionComponent,
  components: {
    SourceHeader,
    AudioPlayer,
    VideoPlayer,
  },
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new SourcePageTransitionController(this);
      this.isReady();
    },
  },
};
