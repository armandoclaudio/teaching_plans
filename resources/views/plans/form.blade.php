<div class="columns">
    <div class="column">
        <div class="field">
            <label class="label">Title</label>
            <p class="control">
                <input type="text" class="input" v-model="title" required>
                <p class="help is-danger" v-if="hasError('title')" v-text="getError('title')"></p>
            </p>
        </div>
    </div>
</div>

<div class="columns">
    <div class="column">
        <div class="field">
            <label class="label">Grade</label>
            <div class="select is-fullwidth">
                <select v-model="grade" class="" required>
                    <option value="">----</option>
                    <option v-for="g in ['K','1st','2nd','3rd','4th','5th','6th','7th','8th','9th','10th','11th','12th']" :value="g">@{{ g }}</option>
                </select>
            </div>
            <p class="help is-danger" v-if="hasError('grade')" v-text="getError('grade')"></p>
        </div>
    </div>
    <div class="column">
        <div class="field">
            <label class="label">From</label>
            <p class="control">
                <input type="date" name="date_from" class="input" v-model="date_from" required>
                <p class="help is-danger" v-if="hasError('date_from')" v-text="getError('date_from')"></p>
            </p>
        </div>
    </div>
    <div class="column">
        <div class="field">
            <label class="label">To</label>
            <p class="control">
                <input type="date" name="date_to" class="input" v-model="date_to" required>
                <p class="help is-danger" v-if="hasError('date_to')" v-text="getError('date_to')"></p>
            </p>
        </div>
    </div>
</div>

<hr>

<h1 class="title is-5">Standards</h1>
<ul>
    <li v-for="standard in standards">
        @{{ standard }}
    </li>
</ul>
<button class="button is-small" @click.prevent="chooseStandards">Add</button>
<hr>

<div v-show="expectations.length > 0">
    <h1 class="title is-5">Expectations</h1>
    <ul>
        <li v-for="expectation in expectations">
            @{{ expectation }}
        </li>
    </ul>

    <hr>
</div>

<h1 class="title is-5">Essential Questions</h1>

<p>
    <media-textarea
        v-for="(essential_question, index) in essential_questions"
        placeholder="Add an essential question..."
        @close="essential_questions.splice(index, 1)"
        :key="getRandomInteger()"
        v-bind:value="essential_question"
        v-on:input="essential_questions[index] = arguments[0]"></media-textarea>
</p>

<button class="button is-small" @click.prevent="essential_questions.push('')">Add</button></b>
<hr>

<h1 class="title is-5">Objectives</h1>

<p>
    <media-textarea
        v-for="(objective, index) in objectives"
        placeholder="Add an objective..."
        @close="objectives.splice(index, 1)"
        :key="getRandomInteger()"
        v-bind:value="objective"
        v-on:input="objectives[index] = arguments[0]"></media-textarea>
</p>

<button class="button is-small" @click.prevent="objectives.push('')">Add</button>
<hr>
<h1 class="title is-5">Evaluations</h1>

<p>
    <media-textarea
        v-for="(evaluation, index) in evaluations"
        placeholder="Add an evaluation..."
        @close="evaluations.splice(index, 1)"
        :key="getRandomInteger()"
        v-bind:value="evaluation"
        v-on:input="evaluations[index] = arguments[0]"></media-textarea>
</p>

<button class="button is-small" @click.prevent="evaluations.push('')">Add</button>
<hr>
<h1 class="title is-5">Activities</h1>

<p>
    <media-textarea
        v-for="(activity, index) in activities"
        placeholder="Add an activity..."
        @close="activities.splice(index, 1)"
        :key="getRandomInteger()"
        v-bind:value="activity"
        v-on:input="activities[index] = arguments[0]"></media-textarea>
</p>

<button class="button is-small" @click.prevent="activities.push('')">Add</button>
<hr>
<h1 class="title is-5">Daily plan</h1>
<hr>
<h1 class="title is-6" v-if="daily_plan.length == 0">- Set the dates above -</h1>
<div v-for="(day, day_index) in daily_plan">
    <h1 class="title is-5">@{{ day.date }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Plan</th>
                <th width="10"><p class="has-text-centered">Time</p></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(plan, index) in day.plans">
                <td>
                    <textarea class="textarea" v-model="day.plans[index].plan"></textarea>
                    <a v-show="day.plans[index].plan != ''" @click="moveToPreviousDay(day_index, index)">Move to previous day</a>
                    <a class="is-pulled-right" v-show="day.plans[index].plan != ''" @click="moveToNextDay(day_index, index)">Move to next day</a>
                </td>
                <td class="has-text-centered">
                    <div class="select">
                        <select v-model="day.plans[index].time">
                            <option value="">----</option>
                            <option v-for="mins in [5,10,15,20,25,30,35,40,45,50, 55, 60]" :value="mins">@{{ mins }} mins</option>
                        </select>
                    </div>
                    <a class="delete" style="margin-top:15px" @click="day.plans.splice(index, 1)"></a>
                </td>
            </tr>
        </tbody>
    </table>
    <button class="button is-small" @click.prevent="addPlan(day)">Add</button>
    <hr>
</div>

<h1 class="title is-5">Observations</h1>
<div class="field">
    <textarea class="textarea" type="text" v-model="observations"></textarea>
</div>

<div class="field">
    <div class="control">
        <button class="button is-primary">Save</button>
    </div>
</div>

<plans-modal
    title="Standards"
    v-show="is_standard_modal_open"
    @save="saveStandards"
    @close="is_standard_modal_open = false">

    <div class="field">
        <div class="control">
            <input
                class="input"
                type="text"
                placeholder="Search..."
                v-model="standards_filter">
        </div>
    </div>

    <hr>

    <div v-for="standard in filtered_standards">
        <label class="checkbox">
            <p>
                <input type="checkbox" :value="standard.description" v-model="selecting_standards">
                @{{ standard.description }}
            </p>

            <p v-for="expectation in filteredExpectations(standard)" class="indented">
                <label class="checkbox">
                    <input type="checkbox" :value="expectation" v-model="selecting_expectations">
                    @{{ expectation }}
                </label>
            </p>

        </label>
        <hr>
    </div>
</plans-modal>