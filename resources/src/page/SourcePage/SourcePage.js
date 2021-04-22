import { AbstractPageTransitionComponent } from 'vue-transition-component';
import SourcePageTransitionController from './SourcePageTransitionController';
import SourceHeader from '../../component/SourceHeader';
import AudioPlayer from '../../component/AudioPlayer';
import VideoPlayer from '../../component/VideoPlayer';
import PdfViewer from '../../component/PdfViewer';

// @vue/component
export default {
  name: 'SourcePage',
  extends: AbstractPageTransitionComponent,
  components: {
    SourceHeader,
    AudioPlayer,
    VideoPlayer,
    PdfViewer,
  },
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new SourcePageTransitionController(this);
      this.isReady();
      console.log('TRACK_SOURCE', 'SOURCE_ID');
    },
  },
};
