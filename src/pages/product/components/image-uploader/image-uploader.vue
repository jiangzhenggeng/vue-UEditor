<style lang="scss">
  .jui-uploader {

  }
</style>
<template>
  <uploader :options="options" class="jui-uploader" ref="uploader">
    <uploader-unsupport></uploader-unsupport>
    <uploader-list>
      <ul slot-scope="props" class="uploader-list-ul" ref="uploader-list-ul">
        <li>
          <uploader-btn class="uploader-list-inner" :attrs="attrs" ref="uploader-btn">
            <div class="jui-uploader__btn-inner">
              <img src="./uploader.svg"/>
              <div>最大8Mb</div>
            </div>
          </uploader-btn>
        </li>
        <li v-for="file in props.fileList" :key="file.id" :id="`li-id-${file.id}`">
          <uploader-file :file="file" :list="true" class="uploader-list-inner">
            <template slot-scope="props">

            </template>
          </uploader-file>
        </li>
      </ul>
    </uploader-list>
  </uploader>
</template>
<script>

	import $ from 'jquery'

	export default {
		props: {
			imageList: {
				type: Array,
				default: Array
			}
		},
		data() {
			return {
				options: {
					target: UEDITOR_CONFIG.serverUrl + '&action=uploadimage',
					testChunks: false,
					allowDuplicateUploads: true,
					query: {
						uid: 11,
						code: 'c20ad4d76fe97759aa27a0c99bff6710',
						action: 'uploadimage'
					},
					fileParameterName: 'upfile',
					chunkSize: 8 * 1024 * 1024,
					progressCallbacksInterval: 300
				},
				attrs: {
					accept: 'image/jpg,image/jpeg,image/png,image/gif'
				}
			}
		}
	}
</script>