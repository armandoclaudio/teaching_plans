!function(t){function a(e){if(n[e])return n[e].exports;var i=n[e]={i:e,l:!1,exports:{}};return t[e].call(i.exports,i,i.exports,a),i.l=!0,i.exports}var n={};a.m=t,a.c=n,a.d=function(t,n,e){a.o(t,n)||Object.defineProperty(t,n,{configurable:!1,enumerable:!0,get:e})},a.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return a.d(n,"a",n),n},a.o=function(t,a){return Object.prototype.hasOwnProperty.call(t,a)},a.p="",a(a.s=165)}({165:function(t,a,n){t.exports=n(166)},166:function(t,a){window.onload=function(){new Vue({el:"#plans-form",data:{id:0,title:"",grade:"",date_from:"",date_to:"",daily_plan:[],standards_filter:"",available_standards:[],standards:[],selecting_standards:[],expectations:[],selecting_expectations:[],essential_questions:[],objectives:[],activities:[],evaluations:[],observations:"",is_standard_modal_open:!1,errors:{}},mounted:function(){var t=this;this.getPlanId(),this.calculateDates(),axios.get("/standards/all").then(function(a){t.available_standards=a.data}).catch(function(t){}),this.startAutomaticSaves()},computed:{filtered_standards:function(){var t=new RegExp(this.standards_filter,"gi");return this.available_standards.filter(function(a){return a.description.match(t)||a.expectations.filter(function(a){return a.match(t)}).length>0})}},watch:{date_from:function(){this.calculateDates()},date_to:function(){this.calculateDates()},is_standard_modal_open:function(){this.is_standard_modal_open||(this.standards_filter="")}},methods:{getPlanId:function(){var t=this.$el.action.split("/");isNaN(t[t.length-1])||(this.id=1*t[t.length-1],this.getData())},getData:function(){var t=this;axios.get("/plans/"+this.id+"/get").then(function(a){t.title=a.data.title,t.grade=a.data.grade,t.date_from=a.data.date_from,t.date_to=a.data.date_to,t.daily_plan=a.data.daily_plan,t.standards=a.data.standards,t.expectations=a.data.expectations,t.essential_questions=a.data.essential_questions,t.objectives=a.data.objectives,t.evaluations=a.data.evaluations,t.activities=a.data.activities,t.observations=a.data.observations}).catch(function(t){})},calculateDates:function(){if(""==this.date_from||""==this.date_to)return[];var t=moment().range(this.date_from,this.date_to),a=[],n=!0,e=!1,i=void 0;try{for(var s,o=t.by("day")[Symbol.iterator]();!(n=(s=o.next()).done);n=!0){var r=s.value,l=r.format("d");if(0!=l&&6!=l){var d=r.format("dddd MMMM D, YYYY");a.push({date:d,plans:this.getPlans(d)})}}}catch(t){e=!0,i=t}finally{try{!n&&o.return&&o.return()}finally{if(e)throw i}}this.daily_plan=a},getPlans:function(t){for(var a=0;a<this.daily_plan.length;a++)if(this.daily_plan[a].date==t&&this.daily_plan[a].plans.length>0)return this.daily_plan[a].plans;return[this.getEmptyPlanObject()]},getEmptyPlanObject:function(){return{plan:"",time:""}},filteredExpectations:function(t){var a=new RegExp(this.standards_filter,"gi");return t.expectations.filter(function(t){return t.match(a)})},chooseStandards:function(){this.selecting_standards=this.standards,this.selecting_expectations=this.expectations,this.is_standard_modal_open=!0},saveStandards:function(){this.standards=this.selecting_standards,this.expectations=this.selecting_expectations,this.is_standard_modal_open=!1},selectedExpectations:function(t){return this.expectations.filter(function(a){return t.indexOf(a)>=0})},addEssentialQuestion:function(t){t.essential_questions.push("")},addPlan:function(t){this.addEmptyDayPlan(t)},addEmptyDayPlan:function(t){t.plans.push(this.getEmptyPlanObject())},moveUp:function(t,a){a<=0||this.daily_plan[t].plans.splice(a-1,0,this.daily_plan[t].plans.splice(a,1)[0])},moveDown:function(t,a){a>=this.daily_plan[t].plans.length-1||this.daily_plan[t].plans.splice(a+1,0,this.daily_plan[t].plans.splice(a,1)[0])},moveToPreviousDay:function(t,a){if(t-1==-1){do{this.date_from=moment(this.date_from).add(-1,"days").format("YYYY-MM-DD")}while(0==moment(this.date_from).format("d")||6==moment(this.date_from).format("d"));this.calculateDates()}var n=t-1,e=t;-1==n&&(n=0,e=1),this.daily_plan[n].plans.push(this.daily_plan[e].plans[a]),t-1==-1&&this.daily_plan[n].plans.splice(0,1),this.daily_plan[e].plans.splice(a,1),0==this.daily_plan[e].plans.length&&this.addEmptyDayPlan(this.daily_plan[e])},moveToNextDay:function(t,a){if(t+1==this.daily_plan.length){do{this.date_to=moment(this.date_to).add(1,"days").format("YYYY-MM-DD")}while(0==moment(this.date_to).format("d")||6==moment(this.date_to).format("d"));this.calculateDates()}this.daily_plan[t+1].plans.unshift(this.daily_plan[t].plans[a]),t+1==this.daily_plan.length-1&&this.daily_plan[t+1].plans.splice(1,1),this.daily_plan[t].plans.splice(a,1),0==this.daily_plan[t].plans.length&&this.addEmptyDayPlan(this.daily_plan[t])},submitForm:function(){var t=this;axios.post(this.$el.action,this.$data).then(function(t){t.data.success&&(location.href="/")}).catch(function(a){return t.errors=a.response.data})},hasError:function(t){return this.errors.hasOwnProperty(t)},getError:function(t){return this.errors[t][0]},clearError:function(t){this.errors.hasOwnProperty(t)&&delete this.errors[t]},getRandomInteger:function(){return 1e6*Math.random()+0},startAutomaticSaves:function(){var t=this;setInterval(function(){return t.save()},12e4)},save:function(){var t=this;axios.post(this.$el.action,this.$data).then(function(a){if(a.data.success&&a.data.id){var n=a.data.id;window.history.replaceState({},"","/plans/"+n+"/edit"),t.$el.action="/plans/"+n}}).catch(function(a){return t.errors=a.response.data})}}})}}});