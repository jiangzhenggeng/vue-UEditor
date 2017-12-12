<style lang="less">
  .insert__card-link {
    max-height: 380px;
    overflow-y: scroll;
    padding-right: 15px;
    &::-webkit-scrollbar {
      width: 3px;
      height: 3px;
    }
    .catch-button {
      display: block;
      width: 100%;
    }
  }

  .avatar-uploader {
    .el-upload {
      width: 80px;
      height: 80px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px dashed #b4bccc;
      border-radius: 5px;
      overflow: hidden;
      &:active {
        opacity: 0.7;
      }
    }
    .el-icon-upload {
      font-size: 34px;
      color: #b4bccc;
    }
    img {
      display: block;
      width: 100%;
    }
  }
</style>


<template>
  <div class="insert__card-link">
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="80px">
      <el-form-item label="卡片类型" prop="type">
        <el-radio-group v-model="ruleForm.type">
          <el-radio :label="0">单品</el-radio>
          <el-radio :label="1">其他链接</el-radio>
        </el-radio-group>
      </el-form-item>

      <el-form-item label="购买链接" prop="url">
        <el-col :span="18">
          <el-input v-model="ruleForm.url"></el-input>
        </el-col>
        <el-col :span="6">
          <div class="mgl10">
            <el-button class="catch-button" @click="resetForm('ruleForm')">抓取</el-button>
          </div>
        </el-col>
      </el-form-item>

      <el-form-item label="名称" prop="title">
        <el-input v-model="ruleForm.title"></el-input>
      </el-form-item>

      <el-form-item label="来源" prop="mall">
        <el-input v-model="ruleForm.mall"></el-input>
      </el-form-item>

      <el-form-item label="价格" prop="price">
        <el-input v-model="ruleForm.price"></el-input>
      </el-form-item>

      <el-form-item label="货币类型" prop="currencyname">
        <el-select v-model="ruleForm.currencyname" placeholder="请选择货币类型">
          <el-option label="￥人民币" value="RMB"></el-option>
          <el-option label="$美元" value="MY"></el-option>
        </el-select>
      </el-form-item>

      <el-form-item label="产品图片" prop="type">
        <el-upload
          class="avatar-uploader"
          action="https://jsonplaceholder.typicode.com/posts/"
          :show-file-list="false"
          :on-success="handleAvatarSuccess"
          :before-upload="beforeAvatarUpload"
        >
          <img v-if="ruleForm.cover" :src="`http://s1.jiguo.com/${ruleForm.cover}/230x230`"/>
          <i v-else class="el-icon-upload"></i>
        </el-upload>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="submitForm('ruleForm')">立即创建</el-button>
        <el-button @click="resetForm('ruleForm')">重置</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>
<script>
	import base64 from '../../../../tools/base64'
	import $ from 'jquery'
	import busEvent from './busEvent'

	export default {
		data() {
			return {
				ruleForm: {
					type: 0,
					url: '',
					title: '',
					mall: '',
					price: '',
					currencyname: 'RMB',
					cover: ''
				},
				rules: {
					type: [
						{
							required: true,
							validator(rule, value, callback) {
								value = String(value)
								if (value != '0' && value != '1') {
									callback(new Error('请选择链接类型'));
								} else {
									callback();
								}
							},
							trigger: 'change'
						}
					],
					url: [
						{
							required: true,
							validator(rule, value, callback) {
								if (!/^https?:\/\/.+/.test(value)) {
									callback(new Error('请填写链接地址'));
								} else {
									callback();
								}
							},
							trigger: 'blur'
						}
					],
					title: [
						{
							required: true,
							message: '请填写标题',
							trigger: 'blur'
						}
					],
					mall: [
						{
							required: true,
							message: '请填写来源',
							trigger: 'blur'
						}
					],
					price: [
						{
							required: true,
							validator(rule, value, callback) {
								if (!/^[\d\.]+/.test(value)) {
									callback(new Error('请填写价格'));
								} else {
									callback();
								}
							},
							trigger: 'blur'
						}
					],
					currencyname: [
						{
							required: true,
							message: '请选择货币类型',
							trigger: 'blur'
						}
					],
					cover: [
						{
							required: true,
							message: '请上传图片'
						}
					]
				}
			};
		},
		created() {
			if (this.addEventListenerMessage) return
			window.addEventListener("message", this.message, false);
			this.addEventListenerMessage = true
		},
		beforeDestroy() {
			window.removeEventListener("message", this.message, false)
		},
		methods: {
			message(e) {
				if (typeof e.data != 'string') return;

				e.data = e.data.replace(/^\s+|\s+$/g, '')
				if (e.data.substr(0, 1) != '{' || e.data.substr(-1, 1) != '}') {
					return
				}
				var sendData = JSON.parse(e.data);
				this.ruleForm = sendData
				busEvent.$emit('change:tabbar', 'fourth')
			},
			submitForm(formName) {
				this.$refs[formName].validate((valid) => {
					var link_data = String(base64.encode($.param(this.ruleForm))).replace('=', '');
					console.log(base64.decode(link_data))

					if (valid) {
						var link_data = String(base64.encode($.param(this.ruleForm))).replace('=', '');
						var pId = 'id-' + Math.random().toString().replace('.', '')

						var unique = 'unique_id_' + pId
						var card_width = 132;

						var html = '' +
							'<iframe ' +
							'style="display:block;width:440px;height:' + card_width + 'px;max-width:100%;overflow:hidden;border:0;margin:0;padding:0;" ' +
							'data-link="' + link_data + '" ' +
							'data-unique="' + unique + '" ' +
							'src="http://m.jiguo.com/mb/iframe/index?iframe_data=' + link_data + '&unique_id=' + unique + '" ' +
							'></iframe>';

						this.$emit('insert:html', html, function (editor) {
							var iob = $(editor.document).find('[data-unique=' + unique + ']');
							if (iob.length > 0) {
								if (!iob.closest('p').length) {
									html = '<p style="text-align: center">' + html + '</p>'
								}
								iob.after(html);
								iob.remove();
								return false
							}
							return true
						})
						this.$emit('close')

					} else {
						console.log('error submit!!');
						return false;
					}
				});
			},
			resetForm(formName) {
				this.$refs[formName].resetFields();
			},
			handleAvatarSuccess(res, file) {
				this.imageUrl = URL.createObjectURL(file.raw);
			},
			beforeAvatarUpload(file) {
				const isLt8M = file.size / 1024 / 1024 < 8;
				if (!isLt8M) {
					this.$notify.error({
						title: '错误',
						message: '超出限制 8Mb！'
					})
				}
				return isLt8M
			}
		}
	}
</script>