<script setup>
import * as demoCode from '@/views/demos/components/progress/demoCodeProgress'
</script>

<template>
  <VRow>
    <!-- 👉 Progress circular color -->
    <VCol
      cols="12"
      md="6"
    >
      <AppCardCode
        title="Circular Color"
        :code="demoCode.circularColor"
      >
        <p>Alternate colors can be applied to <code>v-progress-circular</code> using the <code>color</code> prop.</p>

        <DemoProgressCircularColor />
      </AppCardCode>
    </VCol>

    <!-- 👉 Progress circular Indeterminate -->
    <VCol
      cols="12"
      md="6"
    >
      <AppCardCode
        title="Circular Indeterminate"
        :code="demoCode.circularIndeterminate"
      >
        <p>Using the <code>indeterminate</code> prop, a <code>v-progress-circular</code> continues to animate indefinitely.</p>

        <DemoProgressCircularIndeterminate />
      </AppCardCode>
    </VCol>

    <!-- 👉 Progress circular Rotate -->
    <VCol
      cols="12"
      md="6"
    >
      <AppCardCode
        title="Circular Rotate"
        :code="demoCode.circularRotate"
      >
        <p>The <code>rotate</code> prop gives you the ability to customize the <code>v-progress-circular</code>'s origin.</p>

        <DemoProgressCircularRotate />
      </AppCardCode>
    </VCol>

    <!-- 👉 Progress circular Size and Width -->
    <VCol
      cols="12"
      md="6"
    >
      <AppCardCode
        title="Circular Size"
        :code="demoCode.circularSize"
      >
        <p>The <code>size</code> and <code>width</code> props allow you to easily alter the size and width of the <code>v-progress-circular</code> component.</p>

        <DemoProgressCircularSize />
      </AppCardCode>
    </VCol>

    <!-- 👉 Progress linear color -->
    <VCol
      cols="12"
      md="6"
    >
      <AppCardCode
        title="Linear Color"
        :code="demoCode.linearColor"
      >
        <p>You can set the colors of the progress bar using the props <code>color</code> and <code>background-color</code>.</p>

        <DemoProgressLinearColor />
      </AppCardCode>
    </VCol>

    <!-- 👉 Progress linear indeterminate -->
    <VCol
      cols="12"
      md="6"
    >
      <AppCardCode
        title="Linear Indeterminate"
        :code="demoCode.linearIndeterminate"
      >
        <p>Using the <code>indeterminate</code> prop, <code>v-progress-linear</code> continuously animates.</p>

        <DemoProgressLinearIndeterminate />
      </AppCardCode>
    </VCol>

    <!-- 👉 Progress linear Reversed -->
    <VCol
      cols="12"
      md="6"
    >
      <AppCardCode
        title="Linear Reversed"
        :code="demoCode.linearReversed"
      >
        <p>Displays reversed progress. The component also has RTL support, such that a progress bar in right-to-left mode with reverse <code>prop</code> enabled will display left-to-right.</p>

        <DemoProgressLinearReversed />
      </AppCardCode>
    </VCol>

    <!-- 👉 Progress linear Rounded -->
    <VCol
      cols="12"
      md="6"
    >
      <AppCardCode
        title="Linear Rounded"
        :code="demoCode.linearRounded"
      >
        <p>The rounded prop is used to apply a border radius to the <code>v-progress-linear</code> component.</p>

        <DemoProgressLinearRounded />
      </AppCardCode>
    </VCol>

    <!-- 👉 Progress linear Striped -->
    <VCol
      cols="12"
      md="6"
    >
      <AppCardCode
        title="Linear Slots"
        :code="demoCode.linearSlots"
      >
        <p>The <code>v-progress-linear</code> component will be responsive to user input when using <code>v-model</code>. You can use the default slot or bind a local model to display inside of the progress.</p>

        <DemoProgressLinearSlots />
      </AppCardCode>
    </VCol>

    <!-- 👉 Progress linear Buffering -->
    <VCol
      cols="12"
      md="6"
    >
      <AppCardCode
        title="Linear Buffering"
        :code="demoCode.linearBuffering"
      >
        <p>The primary value is controlled by <code>v-model</code>, whereas the buffer is controlled by the <code>buffer-value</code> prop.</p>

        <DemoProgressLinearBuffering />
      </AppCardCode>
    </VCol>
  </VRow>
</template>
