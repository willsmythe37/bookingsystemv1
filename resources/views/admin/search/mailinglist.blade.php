@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-sm-2 sidenav">
        </div>

        <div class="col-md-8">
            <h2>Displaying Mailing List Groups</h2>
            <br>
            <p>Within this page are a number of pre-made 'Mailto:' links that will collate groups of user's email
                addresses
                together. When clicking one of the buttons, it should open a blank email using the standard mail
                application on your
                computer or phone.</p>
            <p>by default, email addresses will be added to the 'BCC' column. This stops recipients seeing the email
                addresses of other recipients.</p>
            <p>This has been implemented instead of an internal email system because many developers have great
                difficulty keeping their applications associated email addresses out of peoples junk mail.
                Further to that, it can be a lot more work adding new outgoing email servers if this happens and there
                are no ways to determine if your email has been thrown in the junk mail folder.</p>
            <p>The downside of this is that, if you want multiple users to be able to fire emails out, you need to share
                the business email address and credentials with other admins. Also, freemail services like GMAIL to have
                a 'cap' on the amount of outgoing emails that can be send (250 emails per day?).</p>
            <p style="color: red">Note: Please be aware how junk mail filters work. Adding hyperlinks, images,
                attachments and specific keywords etc, all add a negative 'value' to your email. If the value gets too
                low, it'll be moved into a recipients junk mail folder. Just have a simple
                email signature and only include a link to your website.</p>
            <p hidden>{{ $count = 1 }}</p>

            <div class="btn-group btn-block">
                @foreach($mailinglists as $lists)
                <a class="btn btn-primary" href="mailto:?bcc=
                        @foreach($lists as $user)
                        {{ $user->email }};
                        @endforeach">List {{ $count }}</a>
                @if($count % 4 == 0)</div><br>
            <div class="btn-group btn-block">@endif
                <p hidden>{{ $count = $count + 1 }}</p>
                @endforeach
            </div>
            <br>
            <hr>


        </div>

        <div class="col-sm-2 sidenav">
        </div>

    </div>
</div>
@endsection
