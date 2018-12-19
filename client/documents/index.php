<?php
/**
 * index.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 3/17/18
 */

require_once '../../common/index.php';

verify_session( false );

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SKCAC Home Page</title>
    <link rel="stylesheet"
          href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="//fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet"
          href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
          type="text/css"
          href="http://fonts.googleapis.com/css?family=Tangerine">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono"
          rel="stylesheet">
    <link href="http://jacadevelopment.greenriverdev.com/client/landing/wizard/smart_wizard.min.css"
          rel="stylesheet"
          type="text/css"/>

    <style>
        .force-scroll {
            height: 40vh;
            overflow-y: scroll;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>

<body>
<?php require_once "../headerUserNew.html"; ?>
<div class="container">
    <div class="row">
        <form action='submit-wizard.php'>
            <div id="smartwizard"
                 class='col-12'>
                <ul>
                    <li><a class='h4'
                           href="#handbook">Skcac Handbook<br/>
                            <small>Agreement</small>
                        </a></li>
                    <li><a class='h4'
                           href="#release">Release of Information<br/>
                            <small>Agreement</small>
                        </a></li>
                </ul>

                <div>
                    <div id="handbook"
                         class="">
                        <h2>Skcac Handbook Agreement</h2>
                        <hr>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-3 card p-0'>
                                    <div class='card-header p-2'>
                                        <h5>Legend</h5>
                                    </div>
                                    <div class='card-body p-0 force-scroll'>
                                        <ul class='list-group list-group-flush'>
                                            <li class='list-group-item p-1'><a href='#welcome'>Welcome</a></li>
                                            <li class='list-group-item p-1'><a href='#orientation'>Orientation</a></li>
                                            <li class='list-group-item p-1'><a href='#interpreter'>Right to Interpreter Services/Communication
                                                    Systems</a></li>
                                            <li class='list-group-item p-1'><a href='#organization'>Organization</a></li>
                                            <li class='list-group-item p-1'><a href='#mission'>Mission</a></li>
                                            <li class='list-group-item p-1'><a href='#participation'>Participation in Services/Criteria for
                                                    Employment</a></li>
                                            <li class='list-group-item p-1'><a href='#assessment'>Employment Assessment Services</a></li>
                                            <li class='list-group-item p-1'><a href='#placement'>Job Placement Services</a></li>
                                            <li class='list-group-item p-1'><a href='#replacement'>Replacement Services</a></li>
                                            <li class='list-group-item p-1'><a href='#termination'>Termination Policy</a></li>
                                            <li class='list-group-item p-1'><a href='#rights'>Notice of Rights</a></li>
                                            <li class='list-group-item p-1'><a href='#confidentiality'>Confidentiality</a></li>
                                            <li class='list-group-item p-1'><a href='#participant'>Participant/Employee Information</a></li>
                                            <li class='list-group-item p-1'><a href='#non-descrimination'>Non-Discrimination Policy</a></li>
                                            <li class='list-group-item p-1'><a href='#aids'>AIDS/HIV</a></li>
                                            <li class='list-group-item p-1'><a href='#harassment'>Sexual Harassment</a></li>
                                            <li class='list-group-item p-1'><a href='#accommodation'>Reasonable Accommodation</a></li>
                                            <li class='list-group-item p-1'><a href='#abuse'>Policy on Abuse</a></li>
                                            <li class='list-group-item p-1'><a href='#communication'>Communication</a></li>
                                            <li class='list-group-item p-1'><a href='#closures'>Closures/Adverse Weather Conditions</a></li>
                                            <li class='list-group-item p-1'><a href='#workplace'>Drug Free Workplace</a></li>
                                            <li class='list-group-item p-1'><a href='#dress'>Dress Code</a></li>
                                            <li class='list-group-item p-1'><a href='#grievance'>Appeal/Grievance Procedures</a></li>
                                            <li class='list-group-item p-1'><a href='#suggestions'>Suggestions</a></li>
                                            <li class='list-group-item p-1'><a href='#advocacy'>Advocacy</a></li>
                                            <li class='list-group-item p-1'><a href='#privileges'>Rights and Privileges</a></li>
                                            <li class='list-group-item p-1'><a href='#download'>download and print</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class='col-9 card p-0'>
                                    <div class='card-body p-2 force-scroll'>
                                        <h4 id='welcome'>WELCOME</h4>

                                        <p>Everyone at SKCAC Industries and Employment Services (SKCAC) welcomes you. We hope your
                                            association
                                            with SKCAC will be a great experience. Our organization is dedicated to assisting you to achieve
                                            your employment goal.</p>
                                        <p>This handbook was designed to help you become familiar with our organization. It will answer many
                                            of your questions about such things as services and your rights and privileges as a participant
                                            in
                                            SKCAC employment services. This handbook is considered to be a part of the SKCAC Policy Manual.
                                            The
                                            full set of SKCAC Policies is available for your review located at the SKCAC main office.</p>
                                        <p>This handbook covers policies and procedures associated with the services provided to you by
                                            SKCAC.
                                            You will receive policies and procedures related directly to your employer when placement
                                            services
                                            are provided. When you agree to employment, the employer will provide you with all the necessary
                                            information for employment with their company. SKCAC staff will assist you in the review,
                                            understanding and acknowledgement of information provided by your employer.</p>
                                        <p>SKCAC policies, including the information in this handbook, are specific to your employment
                                            services and the supports SKCAC provides to help you through assessment, job placement, training,
                                            job retention and on-going support services.</p>
                                        <p>Please do not hesitate to ask if you have any questions or do not understand any of the material
                                            covered in the handbook or policy manual.</p>
                                        <p>Upon request, this material will be prepared to accommodate your needs, e.g., taped, large print,
                                            alternate language, etc.</p>
                                        <p>The management and employment program personnel of SKCAC will do everything we can to make your
                                            association with SKCAC a pleasant experience.</p>

                                        <h4 id='orientation'>Orientation</h4>

                                        <p>Your orientation takes place during the intake/orientation process with your employment
                                            specialist.
                                            You will receive the Participant Handbook and meet the SKCAC staff. Your employment specialist
                                            will
                                            help you. They will complete an orientation checklist to insure all areas are covered.</p>
                                        <p>It is the policy of SKCAC to clearly orient each new participant, and his/her parent/guardian, or
                                            NSA (Client Representative) when applicable. SKCAC will utilize the orientation checklist and
                                            criteria for participation in SKCAC programs, depending on the supports or services that you are
                                            authorized to receive. Utilizing the orientation checklist, SKCAC staff will, at a minimum, fully
                                            explain the following to each participant, parent/guardian and NSA, when applicable:</p>
                                        <ul>
                                            <li>Participant rights in his/her relationship with SKCAC</li>
                                            <li>SKCAC’s grievance and complaint procedure</li>
                                            <li>What you can expect through supports and service provided by SKCAC</li>
                                        </ul>
                                        <p>The Employment Specialist or his/her designee will be responsible for orienting each new
                                            participant with a printed document, or other form of explanation that the person understands.
                                            Once
                                            oriented, each participant or his/her guardian/NSA will sign a confirmation of the orientation.
                                            Orientation will be completed within five working days of intake.</p>

                                        <h4 id='interpreter'>Right to Interpreter Services/Communication Systems (28 CRF 35.130; 28 CFR
                                            35.160; 28CFR
                                            35.163)</h4>

                                        <p>It is the policy of this organization to provide alternate formats without unreasonable delay and
                                            at no cost to the requesting recipient. SKCAC will ensure that persons with limited proficiency
                                            in
                                            English have an opportunity equal to that given to persons who are English proficient to apply
                                            for,
                                            receive, and otherwise benefit from services provided.</p>

                                        <h4 id='organization'>Organization</h4>

                                        <p>SKCAC Industries and Employment Services (SKCAC) is a not-for-profit organization under Tax Code
                                            501(c)(3). SKCAC provides assessment, work training, job placement, job retention and on-going
                                            employment services.</p>
                                        <p>SKCAC provides the following employment services:</p>
                                        <ul>
                                            <li>Employment Assessment (CBA)</li>
                                            <li>Job Development</li>
                                            <li>Job Placement</li>
                                            <li>Job Training and Retention</li>
                                            <li>On-going Job Supports (supported employment)</li>
                                        </ul>
                                        <p>SKCAC provides the following training and work opportunities:</p>
                                        <ul>
                                            <li>Assembly</li>
                                            <li>Packaging</li>
                                            <li>Light Manufacturing</li>
                                            <li>Light custodial work at Safeco & CenturyLink Fields (seasonal)</li>
                                        </ul>
                                        <p>SKCAC contracts with private corporations and companies and Federal, State and County
                                            governmental
                                            agencies.</p>

                                        <h4 id='mission'>Mission</h4>

                                        <p>Empowering people with developmental disabilities through gainful employment opportunities.</p>

                                        <h4 id='participation'>Participation in Services/Acceptance Policy</h4>

                                        <p>You are expected to fully participate in the services SKCAC is authorized to provide you. This
                                            includes your cooperation in planning and implementing your services.</p>
                                        <p>SKCAC will provide you with employment services to meet your employment and training needs. SKCAC
                                            will focus on assisting you to increase self-sufficiency, earn wages, and have a better quality
                                            of
                                            life.</p>
                                        <p>You will have an employment specialist who will provide planning services, job development,
                                            training and support to you. Your interests and what you like to do best will be considered in
                                            the
                                            entire process. You will receive an overview of policies in regard to working with SKCAC. You are
                                            encouraged to communicate any and all questions and/or concerns to any staff person of SKCAC.</p>
                                        <p>The following are requirements for participation in SKCAC program(s):</p>
                                        <ul>
                                            <li>The presence of a disability which impairs the individual’s employability.
                                                Medical/psychological
                                                documentation of diagnosed disability with appropriate professional signature(s) is required
                                                or
                                                can be readily obtained by the referring agency.
                                            </li>
                                            <li>Desire to receive employment services from SKCAC. Desire to meet expectations and be an active
                                                participant in the services provided by SKCAC.
                                            </li>
                                            <li>A joint decision by the applicant, referring agent, applicant's guardian/advocate (when
                                                applicable), NSA (Client Representative) and SKCAC program staff that services of SKCAC will
                                                meet the needs of the individual and there is a reasonable expectation that SKCAC services
                                                will
                                                enhance the individual's opportunity for employment in the community.
                                            </li>
                                            <li>Minimum age 18 - DVR, minimum age 21 - DDA (exceptions made with approval from the referring
                                                agency).
                                            </li>
                                            <li>Funding source providing fees for services rendered by SKCAC.</li>
                                            <li>Work behaviors appropriate for a work setting/environment. No known safety concerns to self or
                                                others.
                                            </li>
                                            <li>Capable of maintaining personal cleanliness, eating and caring for personal needs with
                                                assistance/reminders or coordination of personal care services.
                                            </li>
                                            <li>Able to take prescribed medication at time specified with minimal assistance.</li>
                                            <li>Transportation to meetings, worksite, assessment site, etc. Coordination of transportation
                                                services is available through SKCAC placement services although is the participant’s
                                                responsibility.
                                            </li>
                                            <li>Able to communicate with others by speech, writing or other means.</li>
                                            <li>SKCAC evaluation to determine applicant/services/program suitability; generally 30 days.</li>
                                        </ul>

                                        <h4 id='assessment'>Employment Assessment Services</h4>

                                        <p>SKCAC helps you to explore your work interests, skills/abilities, interpersonal and work
                                            behaviors
                                            and independence on the job. We work with you to develop an assessment plan to answer one or more
                                            of the following: vocational interests, work tolerance, attendance, reliability, punctuality,
                                            supervisor/co-worker interaction, response to supervision, dress, grooming, ability to follow
                                            multiple task directions, conditions and circumstances for job placement, types of supports
                                            needed
                                            for working, quality and quantity of work performed and other areas specific to you.</p>

                                        <h4 id='placement'>Job Placement Services</h4>

                                        <p>SKCAC helps you to seek and obtain employment in a community job. We work with you to develop a
                                            personalized plan to determine areas of interest, needed supports and possible barriers to
                                            employment. We spend time with you to explore jobs, develop opportunities and increase your job
                                            seeking skills. We work with employers and do our best to help you to find the job you want and
                                            that is best suited to your employment goals.</p>

                                        <h4 id='replacement'>Replacement Services</h4>

                                        <p>SKCAC is committed to insuring you are satisfied with your job placement and the
                                            services/supports
                                            provided by SKCAC.</p>
                                        <p>If you lose your community job placement and wish for SKCAC to assist you in finding another job
                                            and you continue to meet SKCAC’s criteria for services, the following procedures will be
                                            followed:</p>
                                        <ul>
                                            <li>You and your Employment Specialist will develop a written plan providing the details of job
                                                seeking, areas of interest, etc.
                                            </li>
                                            <li>SKCAC will work with you to develop job opportunities and prepare for job placement.</li>
                                            <li>Replacement services will be evaluated at least every six months to determine progress and
                                                potential for successful job placement.
                                            </li>
                                        </ul>

                                        <h4 id='termination'>Termination Policy</h4>

                                        <p>Non-compliance with the above expectation (Referral Acceptance Policy) may result in termination
                                            from SKCAC services.</p>
                                        <p>If you disagree with the decision of non-acceptance or termination of services, please follow
                                            SKCAC
                                            Appeal/Grievance procedures, outlined in this handbook.</p>

                                        <h4 id='rights'>Rights</h4>

                                        <p>As a participant of services provided by SKCAC, you have the right to:</p>
                                        <ul>
                                            <li>Respectful staff-to-participant interactions;</li>
                                            <li>Be treated with dignity and respect;</li>
                                            <li>Be free from any kind of abuse or punishment including neglect, financial exploitation,
                                                abandonment, humiliation, retaliation, verbal, mental, physical and/or sexual abuse;
                                            </li>
                                            <li>Be free from discrimination and harassment on the basis of race, color, national origin,
                                                gender,
                                                age, religion, creed, marital status, disability, sexual orientation, or the presence of any
                                                physical, mental or sensory disability;
                                            </li>
                                            <li>Be compensated for work at prevailing wages and commensurate with abilities;</li>
                                            <li>Be free from invasion of privacy;</li>
                                            <li>Have information about you treated confidentially;</li>
                                            <li>Actively participate in the development/modification of your service program;</li>
                                            <li>Select your own vocational goals and have final approval on all plans SKCAC helps you with or
                                                makes for you;
                                            </li>
                                            <li>Be provided services in your best interest and related to your needs;</li>
                                            <li>Review your service records, have access to and release of your personal records, as
                                                requested;
                                            </li>
                                            <li>Be fully informed regarding fees to be charged and methods for payment;</li>
                                            <li>Be provided with rules and regulation governing conduct and responsibilities of SKCAC
                                                participants and employees;
                                            </li>
                                            <li>Register complaints and recommendations without interference, reprisal or retaliation;</li>
                                            <li>An appeal/grievance process if you disagree with a SKCAC decision and that the action will not
                                                result in retaliation or barriers to services;
                                            </li>
                                            <li>Involve others in the planning process (spouse, parents, guardian, advocates, etc.);</li>
                                            <li>Informed consent about service delivery, release of information, composition of service
                                                delivery
                                                team, and involvement in research projects;
                                            </li>
                                            <li>Informed right of refusal, when consent is required, with explanation of risks and adverse
                                                consequences of the refusal;
                                            </li>
                                            <li>Access to self-help and advocacy services;</li>
                                            <li>Access or referral to legal entities for appropriate representation, if needed;</li>
                                            <li>Investigation and resolution of alleged infringement of rights.</li>
                                        </ul>

                                        <h4 id='confidentiality'>Confidentiality</h4>

                                        <p>Your Program Services Record/File is stored in the main office area in a locked file cabinet and
                                            on
                                            SKCAC’s password protected case management system. All information about you is confidential and
                                            will only be shared for the purpose of employment and program services with those authorized by
                                            you
                                            on your Release of Information form. Release forms will expire one year after signed. Your file
                                            is
                                            available for your review upon request.</p>

                                        <h4>Health Insurance Portability Accountability Act of 1996 (HIPAA)</h4>

                                        <p>SKCAC agrees not to use or disclose protected health information other than as permitted or
                                            required by law with your approval.</p>

                                        <h4 id='participant'>Participant/Employee Information</h4>

                                        <p>It is important for you to notify SKCAC personnel of any changes to your address, phone number,
                                            emergency contacts, medications, medical alerts, physical limitations, diet restrictions, etc.
                                            This
                                            helps SKCAC to provide appropriate supports to you while you are participating in SKCAC
                                            services.</p>

                                        <h4 id='non-discrimination'>Non-Discrimination Policy</h4>

                                        <p>SKCAC does not discriminate against or tolerate harassment on the basis of race, color, national
                                            origin, gender, age, religion, creed, marital status, disability, sexual orientation, or the
                                            presence of any physical, mental or sensory disability in any aspect of our services, activities,
                                            and employment.</p>

                                        <h4 id='aids'>AIDS/HIV</h4>

                                        <p>It is the policy of SKCAC to treat AIDS and HIV infection as a disability in accordance with
                                            federal law. It also is the policy of SKCAC to provide a workplace for all employees free from
                                            discrimination.</p>

                                        <h4 id='harassment'>Sexual Harassment</h4>

                                        <p>It is the policy of SKCAC to maintain a workplace and services that are free from the
                                            intimidation,
                                            coercion, or harassment, including sexual harassment by employees, participants, managers,
                                            contractors, vendors, volunteers or customers will not be tolerated and should be promptly
                                            reported
                                            to your supervisor or program services personnel.</p>
                                        <p>Participants/Employees are expected to conduct themselves in a business-like manner at all times.
                                            Any behavior that is coercive, intimidating, harassing, or sexual in nature is inappropriate and
                                            prohibited. Incidents of harassment may be subjective in nature. To assist employees and managers
                                            in understanding what harassment is, particularly sexual harassment, the following definition
                                            applies: Any unwelcome sexual advances, requests for sexual favors or other verbal or physical
                                            conduct, either explicitly or implicitly, of a sexual nature.</p>

                                        <h4 id='accommodation'>Reasonable Accommodation</h4>

                                        <p>It is the policy of SKCAC to provide equal employment opportunity for all qualified individuals,
                                            including those with disabilities. SKCAC will provide whatever accommodations it deems reasonable
                                            to enable such qualified individual to perform the essential functions of their job.</p>

                                        <h4 id='abuse'>Policy on Abuse</h4>

                                        <p>It is the policy of SKCAC to protect participants from exploitation, neglect and abuse. SKCAC
                                            staff
                                            must pass criminal background checks provided by the Department of Social and Health Services.
                                            SKCAC immediately reports all incidences of suspected abuse in accordance with the law (RCW
                                            74.34/DSHS DDD Policy 5.13).</p>

                                        <h4 id='communication'>Communication</h4>

                                        <p>SKCAC seeks to effectively communicate with you. You are encouraged to ask questions and to make
                                            known your opinions and suggestions. SKCAC personnel/management is available to you for the
                                            purpose
                                            of answering your questions and forwarding your suggestions.</p>

                                        <h4 id='closures'>Closures/Adverse Weather Conditions</h4>

                                        <p>The SKCAC office facility will, in most cases, be open for business Monday through Friday, 7:30
                                            a.m. - 4:00 p.m. You will be informed in advance of any planned closures.</p>

                                        <p>For snow/adverse weather conditions, use your best judgment based on the conditions.</p>

                                        <p>In a power outage, SKCAC phones work although the ringer does not function so we may not pick up
                                            if
                                            you try calling. You will be provided with appropriate cellular and alternate phone numbers to
                                            reach us after hours and in case of emergency.</p>

                                        <p>Your employment site will have policies and procedures for you to follow in case of business
                                            closure, emergencies, etc.</p>

                                        <h4 id='workplace'>Drug-Free Workplace</h4>

                                        <p>It is the policy of SKCAC to provide a Drug-Free Workplace. Alcohol, marijuana and drugs not
                                            prescribed to you by a qualified physician are not permitted on SKCAC premises. Any employee who
                                            comes to work under such influence will be sent home and will not be paid for that day and will
                                            be
                                            subject to disciplinary action.</p>

                                        <h4 id='dress'>Dress Code</h4>

                                        <p>You are encouraged to maintain a neat and clean appearance. Your placement assignment will
                                            provide
                                            you with expectations for dress and grooming expectations.</p>

                                        <h4 id='grievance'>Appeal/Grievance Procedure</h4>

                                        <p>Please know that you may have an advocate to support and/or to represent you at any step of this
                                            procedure and you are protected from any and all retaliation or reprisal based on your
                                            concerns.</p>

                                        <p>From time to time you or your parent/guardian may disagree with a decision made by staff of
                                            SKCAC.
                                            When this happens, we want to make sure all conflicts are fully negotiated. If a conflict arises,
                                            which cannot be resolved through regular lines of communication, please observe the following
                                            procedure:</p>

                                        <p>1. Attempt to work out the conflict with the immediate person in charge, your Employment
                                            Specialist. Try to work out the conflict and if the conflict cannot be resolved move on to the
                                            next
                                            step.</p>

                                        <p>From this point forward in the process, each step will be documented in writing.</p>

                                        <p>2. Ask for a meeting with a Program Services representative and explain the situation to them.
                                            He/She may ask you to put the disagreement in writing and the Program Services representative
                                            will
                                            make a decision on the conflict within five working days.</p>

                                        <p>3. If you are not satisfied with the decision, please make an appointment, or contact the
                                            Executive
                                            Director of SKCAC and explain the situation to them. He/She may also ask you to put the conflict
                                            in
                                            writing. The Executive Director will make a decision regarding the conflict within five working
                                            days. If you are still not satisfied with the decision of the Executive Director, and then he/she
                                            will refer you to a representative of the Board of Directors, who will review your complaint or
                                            conflict, make a decision in writing and give you a copy within five working days after the next
                                            scheduled Board of Directors meeting.</p>

                                        <p>4. If you still are not satisfied with the decision, then you will be referred to a person or
                                            organization not affiliated with SKCAC, who will proceed as a mediator. Their job is to listen to
                                            you, your parent/guardian, and/or your advocate and SKCAC and to reach a final decision
                                            concerning
                                            your conflict.</p>

                                        <p>The mediator may be a staff member of the ARC, a professional mediator or organization, or
                                            someone
                                            you and SKCAC both agree on. If the person is a professional mediator and charges for the
                                            service,
                                            the parties will divide the cost evenly, unless other arrangements have been made. The mediator
                                            will set the guidelines for the process and keep all parties informed of the process, according
                                            to
                                            the established guidelines. Mediation is voluntary and not legally binding.</p>

                                        <p>Any grievance action will not result in retaliation or barriers to services to you or anyone
                                            involved in the grievance process.</p>

                                        <h4 id='suggestions'>Suggestions</h4>

                                        <p>You are in an excellent position to suggest better ways of doing things at SKCAC. There may be a
                                            way to improve services to you. Your suggestions are encouraged and appreciated.</p>

                                        <h4 id='advocacy'>Advocacy</h4>

                                        <p>Who better than you know what supports are needed in your life, what makes you feel included,
                                            what
                                            your needs, dreams and desires are? It is through your self-advocacy and the advocacy of those
                                            who
                                            you know that insures the decision makers in our community, and beyond, understand what is
                                            important to you. SKCAC encourages you to be involved in speaking up for yourself and what is
                                            important to you. We will include you in decisions about you and provide information and
                                            materials
                                            to assist you in the process of self-advocacy. The SKCAC website: www.skcac.org as well as
                                            newsletters and flyers are some ways we will provide information to you. We encourage your
                                            participation and whenever possible will assist you as needed.</p>

                                        <h4>Self-Advocacy Organizations:</h4>

                                        <p>The Arc of Washington State
                                            2600 Martin Way East, Suite B
                                            Olympia, WA 98506
                                            (360) 357-5596 or Toll-free #1 (888) 754-8798
                                            (360) 357-3279 Fax
                                            www.arcwa.org</p>

                                        <p>Self Advocates in Legislation (SAIL)
                                            By e-mail ucandoit@arcofkingcouty.org or by phone at 1-888-754-8798
                                            www.sailcoalition.org</p>

                                        <p>People First of Washington
                                            Donna Lowary
                                            P.O. Box 648
                                            Clarkston, Washington 99403
                                            Phone: 1-800-758-1123
                                            E-mail: pfow@clarkston.com
                                            www.peoplefirstofwashington.org</p>

                                        <p>Disability Rights of Washington
                                            315 - 5th Avenue South, Suite 850
                                            Seattle, WA 98104
                                            www.disabilityrightswa.org
                                            Voice: 1-800-562-2702 or 206-324-1521
                                            TTY: 1-800-905-0209 or 206-957-0728
                                            Fax: 206-957-0729</p>

                                        <h4 id='privileges'>Rights and Privileges</h4>

                                        <p>All of the rights and privileges of participants in SKCAC services are limited to those
                                            specifically outlined in this policy handbook, those protected under State of Washington law and
                                            those secured under Federal law.</p>

                                        <h4 id='download'>download and print</h4>

                                        <a href="http://jacadevelopment.greenriverdev.com/client/landing/wizard/Handbook.pdf" target="_blank">Print Handbook</a>
                                    </div>
                                </div>
                            </div>
                            <div class='row justify-content-end'>
                                <div class='col-9'>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input class=''
                                                       type='checkbox'
                                                       name='handbook'
                                                       id='wizard-handbook-checkbox-agreement'>
                                            </div>
                                        </div>
                                        <div class='input-group-append'>
                                            <label class='input-group-text'
                                                   for='wizard-handbook-checkbox-agreement'>I have read the handbook.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="release"
                         class="">
                        <h2>Release of Information Agreement</h2>
                        <hr>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-3 card p-0'>
                                    <div class='card-header p-2'>
                                        <h5>Legend</h5>
                                    </div>
                                    <div class='card-body p-0 force-scroll'>
                                        <ul class='list-group list-group-flush'>
                                            <li class='list-group-item p-1'><a href='#Release of Information'>Release of Information</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class='col-9 card p-0'>
                                    <div class='card-body p-2 force-scroll'>

                                        <h4 id='Release of Information'>Release of Information</h4>

                                        <p>I hereby give my permission for SKCAC Industries and Employment Services to exchange necessary information regarding my employment and program services with
                                            the agencies and/or individuals indicated below:</p>



                                        <div class="container">

                                            <label>Referring Agency: </label>
                                            <br>
                                            <input type="text" class="form-control"  aria-label="Text input with checkbox" >
                                            <br>

                                            <label>Residential Provider: </label>
                                            <br>
                                            <input type="text" class="form-control"  aria-label="Text input with checkbox" >
                                            <br>

                                            <label>Parent/Relative: </label>
                                            <br>
                                            <input type="text" class="form-control"  aria-label="Text input with checkbox">
                                            <br>

                                            <label>Guardian: </label>
                                            <br>
                                            <input type="text" class="form-control"  aria-label="Text input with checkbox">
                                            <br>

                                            <label>Funding Agency: </label>
                                            <br>
                                            <input type="text" class="form-control" aria-label="Text input with checkbox" >
                                            <br>

                                            <label>Other: </label>
                                            <input type="text" class="form-control" aria-label="Text input with checkbox">
                                            <br>
                                        </div>

                                        <p> The information may be released via mail, phone, personal interview, fax or other means of communication.</p>

                                        <p> I have been informed that information about me is confidential and restricted for employment and program services purposes only.</p>

                                    </div>
                                </div>
                            </div>
                            <div class='row justify-content-end'>
                                <div class='col-9'>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input class=''
                                                       type='checkbox'
                                                       name='handbook'
                                                       id='wizard-handbook-checkbox-agreement'>
                                            </div>
                                        </div>
                                        <div class='input-group-append'>
                                            <label class='input-group-text'
                                                   for='wizard-handbook-checkbox-agreement'>I have read the handbook.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <br>

    <?php include '../footer.html'; ?>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript"
            src="http://jacadevelopment.greenriverdev.com/client/landing/wizard/jquery.smartWizard.min.js"></script>
    <script>
        let clientId = <?= $_SESSION['clientid'] ?>;

        $(document).ready(function () {
            $('#smartwizard').smartWizard();

            // Contact Events
            let contactList = $('#contacts-list');
            let confirmAddContact = $('#contact-add-button-confirm');
            let addContactModal = $('#add-contact');

            confirmAddContact.on('click', function(){
                $.ajax({
                    url: '/api/client/' + clientId + '/contact',
                    method: 'post',
                    data: {
                        first_name: $('#contact-add-input-first-name').val(),
                        last_name: $('#contact-add-input-last-name').val(),
                        relation: $('#contact-add-select-relation').val(),
                        email: $('#contact-add-input-email').val(),
                        phone: $('#contact-add-input-phone').val(),
                        address: $('#contact-add-input-address').val(),
                        address_city: $('#contact-add-input-address-city').val(),
                        address_zip: $('#contact-add-input-address-zip').val(),
                        address_state: $('#contact-add-input-address-state').val()
                    },
                    success: function(){
                        addContactModal.modal('hide');
                        renderContacts();
                    }
                });
            });


            function renderContacts(){
                $.ajax({
                    url: 'contact_list.php',
                    method: 'get',
                    data: {
                        client_id: clientId
                    },
                    success: function(data){
                        contactList.html(data);
                        $('[data-delete]').on('click', function(){
                            let id = $(this).data('id');

                            $.ajax({
                                url: '/api/remove_contact/' + id,
                                method: 'get',
                                success: function(){
                                    renderContacts();
                                }
                            });
                        });
                    }
                });
            }

            renderContacts();

            // Emergency Contact Events
            let emergencyContacList = $('#emergency-contact-list');
            let confirmAddEmergencyContact = $('#emergency-contact-confirm-button');
            let addEmergencyContactModal = $('#add-emergency-contact');

            confirmAddEmergencyContact.on('click', function(){
                $.ajax({
                    url: '/api/client/' + clientId + '/emergency_contact',
                    method: 'post',
                    data: {
                        first_name: $('#emergency-contact-add-input-first-name').val(),
                        last_name: $('#emergency-contact-add-input-last-name').val(),
                        phone: $('#emergency-contact-add-input-phone').val(),
                        alternate_phone: $('#emergency-contact-add-input-phone-alt').val(),
                    },
                    success: function(){
                        addEmergencyContactModal.modal('hide');
                        renderEmergencyContacts();
                    }
                });
            });

            function renderEmergencyContacts(){
                $.ajax({
                    url: 'emergency_contact_list.php',
                    method: 'get',
                    data: {
                        client_id: clientId
                    },
                    success: function(data){
                        emergencyContacList.html(data);
                        $('[data-delete="emergency_contact"]').on('click', function(){
                            let id = $(this).data('id');

                            $.ajax({
                                url: '/api/remove_emergency_contact/' + id,
                                method: 'get',
                                success: function(){
                                    renderEmergencyContacts();
                                }
                            });
                        });
                    }
                });
            }

            renderEmergencyContacts();
        });

        $('.input-group').find('input').on('input', function () {
            let input = $(this);
            if (input.prop('required')) {
                let span = input.parent().find('span');
                if (input.val() === "") {
                    span.removeClass('bg-success');
                    span.addClass('bg-danger');
                    span.html("<i data-feather='x-circle'>X</i>");
                    feather.replace();
                    input.addClass('is-invalid');
                } else {
                    span.removeClass('bg-danger');
                    span.addClass('bg-success');
                    span.html("<i data-feather='check-circle'>:)</i>");
                    feather.replace();
                    input.removeClass('is-invalid');
                }
            }
        });
    </script>
</body>
</html>
