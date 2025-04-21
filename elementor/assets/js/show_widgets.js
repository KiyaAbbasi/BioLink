function show_widgets ( category )
{
    var tabs = this.closest( '.tabs' );
    var contents = tabs.parentNode.parentNode.querySelectorAll( '.content' );
    contents.forEach( function ( content )
    {
        content.style.display = 'none';
    } );

    var tabButtons = tabs.querySelectorAll( '.tab-btn' );
    var activeTabIndex = Array.from( tabButtons ).findIndex( tab => tab.classList.contains( 'active' ) );
    tabButtons.forEach( function ( tab )
    {
        tab.classList.remove( 'active' );
        var icon = tab.querySelector( 'i' );
        if ( icon )
        {
            icon.classList.remove( 'fa-square-check' );
            icon.classList.add( 'fa-square-plus' );
        }
    } );
    var index = Array.from( tabButtons ).indexOf( this );
    if ( category === 'prev' )
    {
        index = ( activeTabIndex === 0 ) ? tabButtons.length - 1 : activeTabIndex - 1;

    } else if ( category === 'next' )
    {
        index = ( activeTabIndex === tabButtons.length - 1 ) ? 0 : activeTabIndex + 1;
    }

    var newActiveTab = tabButtons[ index ];
    category = newActiveTab.getAttribute( 'data-category' );
    var activeTab = tabs.querySelector( '.tab-btn[data-category="' + category + '"]' );

    if ( activeTab )
    {
        activeTab.classList.add( 'active' );
        var activeIcon = activeTab.querySelector( 'i' );
        if ( activeIcon )
        {
            activeIcon.classList.remove( 'fa-square-plus' );
            activeIcon.classList.add( 'fa-square-check' );
        }
        var targetContent = tabs.parentNode.parentNode.querySelector( '.content#' + category );
        if ( targetContent )
        {
            targetContent.style.display = 'block';
        }
    }

}