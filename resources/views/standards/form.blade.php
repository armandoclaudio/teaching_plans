<div class="field">
    <label class="label">Description</label>
    <p class="control">
        <textarea class="textarea" name="description" :class="{ 'is-danger' : hasError('description') }" id="standard-description" v-model="description"></textarea>
        <p class="help is-danger" v-if="hasError('description')" v-text="getError('description')"></p>
    </p>
</div>

<h3 class="title is-4">Expectations</h3>
<article class="message" v-for="(expectation, i) in expectations">
    <div class="message-header">
        Expectation @{{ i + 1 }}
        <button class="delete is-small remove-expectation" @click="expectations.splice(i, 1)"></button>
    </div>
    <div class="message-body no-padding">
        <p class="control">
            <textarea class="textarea expectation no-border-radius" v-model="expectations[i]"></textarea>
        </p>
    </div>
</article>

<div class="field is-grouped">
    <p class="control">
        <button class="button" id="add-expectation" @click.prevent="addExpectation">Add new expectation</button>
    </p>
    <p class="control">
        <button class="button is-primary" id="submit">Submit</button>
    </p>
</div>