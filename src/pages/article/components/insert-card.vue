<style lang="less">
  @import "./bottom-btn";

  .insert-card {
    &.model__wrap .model__body {
      padding-top: 0;
    }
  }

  .el-tabs__active-bar,
  .el-tabs__nav-wrap::after {
    height: 1px;
  }

  .el-tabs__item {
    font-weight: normal;
  }
</style>


<template>
  <transition name="window__modal">
    <dialog-base
      v-show="inner_visibile"
      @close="close"
      title="插入卡片"
      class="insert-card"
    >
      <el-tabs v-model="activeName">
        <el-tab-pane label="产品库" name="second">
          <insert-card-product
            @insert:html="insertCard"
            @close="close"
          />
        </el-tab-pane>
        <el-tab-pane label="优惠券" name="third">
          <insert-card-coupons
            @insert:html="insertCard"
            @close="close"
          />
        </el-tab-pane>
        <el-tab-pane label="链接" name="fourth">
          <insert-card-link
            @insert:html="insertCard"
            @close="close"
          />
        </el-tab-pane>
        <el-tab-pane label="秒杀" name="fifth">
          <insert-card-second-kill
            @insert:html="insertCard"
            @close="close"
          />
        </el-tab-pane>
      </el-tabs>
      <!--<div class="dialog__bottom-wrap" slot="bottom">-->
      <!--<div class="dialog__bottom gary" @click="close">关闭</div>-->
      <!--<div class="dialog__bottom red" @click="clickOk">确定</div>-->
      <!--</div>-->
    </dialog-base>
  </transition>
</template>
<script>
	import mixins from './mixins'
	import InsertCardProduct from './cardComponents/insert-card-product'
	import InsertCardCoupons from './cardComponents/insert-card-coupons'
	import InsertCardLink from './cardComponents/insert-card-link'
	import InsertCardSecondKill from './cardComponents/insert-card-second-kill'
	import busEvent from './cardComponents/busEvent'

	export default {
		mixins: [mixins],
		data() {
			return {
				activeName: 'second'
			};
		},
		components: {
			InsertCardProduct,
			InsertCardCoupons,
			InsertCardLink,
			InsertCardSecondKill
		},
		created() {
			busEvent.$on('change:tabbar', (name) => {
				this.activeName = name
			})
		},
		methods: {
			insertCard(html, callBack) {
				this.$emit('insert:html', html, callBack)
			}
		}
	}
</script>