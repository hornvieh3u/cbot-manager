export default [
  { heading: 'Others' },
  {
    title: 'Access Control',
    icon: { icon: 'tabler-shield' },
    to: 'access-control',
    action: 'read',
    subject: 'Auth',
  },
  {
    title: 'Nav Levels',
    icon: { icon: 'tabler-menu-2' },
    children: [
      {
        title: 'Level 2.1',
        to: null,
      },
      {
        title: 'Level 2.2',
        children: [
          {
            title: 'Level 3.1',
            to: null,
          },
          {
            title: 'Level 3.2',
            to: null,
          },
        ],
      },
    ],
  },
  {
    title: 'Disabled Menu',
    to: null,
    icon: { icon: 'tabler-eye-off' },
    disable: true,
  },
  {
    title: 'Raise Support',
    href: 'https://pixinvent.ticksy.com/',
    icon: { icon: 'tabler-lifebuoy' },
    target: '_blank',
  },
  {
    title: 'Documentation',
    href: 'https://pixinvent.com/demo/vuexy-vuejs-admin-dashboard-template/documentation/',
    icon: { icon: 'tabler-file' },
    target: '_blank',
  },
]
