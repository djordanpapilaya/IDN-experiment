import { AbstractPageTransitionComponent } from 'vue-transition-component';
import SourcePageTransitionController from './SourcePageTransitionController';
import SourceHeader from '../../component/SourceHeader';
import AudioPlayer from '../../component/AudioPlayer';
import VideoPlayer from '../../component/VideoPlayer';
import PdfViewer from '../../component/PdfViewer';
import { getValue } from '../../util/injector';
import { GATEWAY } from '../../data/Injectables';
import { mapMutations } from 'vuex';
import { SET_RESOURCE } from '../../store/module/app/app';

// @vue/component
export default {
  name: 'SourcePage',
  extends: AbstractPageTransitionComponent,
  data() {
    return {
      resourceLoaded: false,
      data: null,
    };
  },
  components: {
    SourceHeader,
    AudioPlayer,
    VideoPlayer,
    PdfViewer,
  },
  created() {
    this.loadResource();
  },
  methods: {
    ...mapMutations({
      setResource: SET_RESOURCE,
    }),
    handleAllComponentsReady() {
      this.transitionController = new SourcePageTransitionController(this);
      this.isReady();
      this.trackResource();
    },
    loadResource() {
      const gateway = getValue(GATEWAY);
      const path = this.$route.params.name;
      console.log(path);

      gateway.get('resource/' + path).then((result) => {
        this.setResource(result.data);
        this.data = result.data;
      }).then(() => {
        this.resourceLoaded = true;
      });
    },
    trackResource() {
      console.log('TRACK_SOURCE', 'SOURCE_ID');
    },
  },
};
